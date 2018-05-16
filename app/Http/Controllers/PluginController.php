<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePluginRequest;
use App\Option;
use App\Permission;
use App\Plugin;
use Carbon\Carbon;
use Efriandika\LaravelSettings\Settings;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class PluginController extends Controller
{
    public function getList()
    {
        $allfolder    =   Storage::directories('plugins/');
        $plugins = array_map('basename',$allfolder);
        $plugin_list    =   [];
        foreach($plugins as $item){
            $json   =   json_decode(File::get(base_path('plugins/'.$item.'/composer.json')));
            $plugin =   [
                'folder'    =>  $item,
                'name'  =>  !empty($json->name)?$json->name:'',
                'description'   =>  !empty($json->description)?$json->description:'',
                'author'    =>  !empty($json->authors[0]->name)?$json->authors[0]->name:'',
                'email'     =>  !empty($json->authors[0]->email)?$json->authors[0]->email:'',
                'mainroute' =>  !empty($json->mainroute)?$json->mainroute:'',
                'icon'      =>  !empty($json->icon)?$json->icon:'fa fa-puzzle-piece',
                'installed'    =>  FALSE
            ];
            if(Plugin::where('folder',$item)->count()>0){
                $plugin['installed']    =   TRUE;
            }
            $plugin_list[]  =   $plugin;
        }
//        echo '<pre>';
//        print_r($plugin_list);
//        echo '</pre>';
        return v('plugins.list', compact('plugin_list'));
    }

    public function getInstallPlugin($plugin)
    {
        $pluginClass    =   ucfirst($plugin);
        if(Storage::disk('local')->exists("plugins/$plugin") && Storage::disk('local')->exists("plugins/$plugin/src/".$pluginClass."Plugin.php") && Plugin::where('folder',$plugin)->count() == 0){
            $json   =   json_decode(File::get(base_path('plugins/'.$plugin.'/composer.json')));
            $classFullname      =   "\\v2CRM\\$pluginClass\\$pluginClass"."Plugin";
            $data   =   new $classFullname();
            $menu_json  =   [];
            foreach($data->getMenu() as $mn){
                if($mn['menu']==TRUE)
                    $menu_json[]    =   $mn;
            }
            $option_json    =   json_encode($data->getOptions());
            $mplugin   =   new Plugin();
            $mplugin->name   =   $data->getName();
            $mplugin->icon  =   !empty($json->icon)?$json->icon:'fa fa-puzzle-piece';
            $mplugin->folder =   $plugin;
            $mplugin->menu    =   json_encode($menu_json);
            $mplugin->options    =   $option_json;
            $mplugin->enabled   =   1;
            $mplugin->installed_at   =   Carbon::now();
            $mplugin->save();
            foreach($data->getMenu() as $item){
                $permission = [
                    'permission' => $item['path'],
                    'name' => $item['name'],
                    'method' => $item['method'],
                    'type' => !empty($item['role']) ? 'private' : 'public',
                    'created_at' => \Carbon\Carbon::now()
                ];
                $id = Permission::insertGetId($permission);
                if ($permission['type'] == 'private') {
                    Permission::find($id)->group()->attach(explode(',', $item['role']));
                }
            }
            foreach($data->getSettings() as $item){
                $option =   [
                    'name'  =>  $item['name'],
                    'label' =>  $item['label'],
                    'type'  =>  $item['type'],
                    'source'    =>  $plugin,
                    'default'   =>  $item['default'],
                    'values'    =>  $item['values']
                ];
                Option::insert($option);
                \Settings::set($plugin.'_'.$item['name'],$item['default']);
            }
            Artisan::call("migrate", array('--path' => "plugins/$plugin/src/migrations"));
            set_notice(trans('plugins.install_success'),'success');
        }
        else
            set_notice(trans('plugins.plugin_not_found'), 'danger');
        return redirect()->to(asset('config/plugins'));
    }

    public function getUninstallPlugin($plugin)
    {
        $pluginClass    =   ucfirst($plugin);
        if(Storage::disk('local')->exists("plugins/$plugin") && Storage::disk('local')->exists("plugins/$plugin/src/".$pluginClass."Plugin.php") && Plugin::where('folder',$plugin)->count() > 0){
            $classFullname      =   "\\v2CRM\\$pluginClass\\$pluginClass"."Plugin";
            $data   =   new $classFullname();
            Plugin::where('folder', $plugin)->forceDelete();
            if(!empty($data->getMenu())){
                foreach($data->getMenu() as $item){
                    if(!empty($per = Permission::where('permission', $item['path'])) && !empty($per->first())){
                        $per->first()->group()->detach();
                        $per->forceDelete();
                    }
                }
            }

            Option::where('source', $plugin)->forceDelete();
            if(!empty($data->getSettings())){
                foreach($data->getSettings() as $item){
                    \Settings::forget($plugin.'_'.$item['name']);
                }
            }

            if(!empty($data->getTablename())){
                foreach($data->getTablename() as $item){
                    Schema::dropIfExists($item);
                }
            }

            set_notice(trans('plugins.uninstall_success'),'success');
        }
        else
            set_notice(trans('plugins.plugin_not_found'), 'danger');
        return redirect()->to(asset('config/plugins'));
    }

    public function getCreate()
    {
        return v('plugins.create');
    }

    public function postCreate(CreatePluginRequest $request)
    {
        $name   =   $request->name;
        if(Storage::exists('plugins/'.$name)){
            set_notice(trans('plugins.plugin_existing'), 'info');
            return redirect()->back();
        }else{
            if(!empty($request->tables)){
                $tables =   explode(',', $request->tables);
                $existing   =   [];
                foreach($tables as $table){
                    if(Schema::hasTable($table))
                        $existing[] =   $table;
                }
                if(!empty($existing)){
                    set_notice(trans('plugins.table_existing').': '.implode(', ', $existing), 'info');
                    return redirect()->back();
                }
            }
        }

        $class  =   ucfirst($name);


        Storage::makeDirectory("plugins/$name");
        Storage::makeDirectory("plugins/$name/Controllers");
        Storage::makeDirectory("plugins/$name/migrations");
        Storage::makeDirectory("plugins/$name/Models");
        Storage::makeDirectory("plugins/$name/views");
        Storage::copy('/app/v2CRM/plugin_template/src/assets', "plugins/$name/src/assets");

        //create composer.json
        $composer_content   =   Storage::get('app/v2CRM/plugin_template/composer.json');
        $composer_content   =   str_replace('{plugin_name}', $name, $composer_content);
        $composer_content   =   str_replace('{plugin_description}', $request->description, $composer_content);
        $composer_content   =   str_replace('{plugin_type}', $request->type, $composer_content);
        $composer_content   =   str_replace('{plugin_license}', $request->license, $composer_content);
        $composer_content   =   str_replace('{plugin_icon}', $request->icon, $composer_content);
        $composer_content   =   str_replace('{author_name}', auth()->user()->name, $composer_content);
        $composer_content   =   str_replace('{author_email}', auth()->user()->email, $composer_content);

        Storage::put("plugins/$name/composer.json", $composer_content);

        //create Controller
        $controller   =   Storage::get('app/v2CRM/plugin_template/src/Controllers/SampleController.php');
        $controller =   str_replace('Sample', $class, $controller);

        Storage::put("plugins/$name/src/Controllers/".$class."Controller.php", $controller);

        //create lang
        Storage::copy('/app/v2CRM/plugin_template/src/lang', "plugins/$name/src/lang");

        //create migrations and models
        if(!empty($request->tables)){
            $tables =   explode(',', $request->tables);

            $migration  =   Storage::get('/app/v2CRM/plugin_template/src/migrations/migration.php');
            $model  =   Storage::get('/app/v2CRM/plugin_template/src/Models/Sample.php');
            foreach($tables as $item){
                $item_migration =   str_replace('CreateSampleTable', 'Create'.ucfirst($item).'Table', $migration);
                $item_migration =   str_replace('sample', $item, $item_migration);
                Storage::put("plugins/$name/src/migrations/".date('Y_m_d_his')."_create_".$item."_table.php", $item_migration);

                $item_model =   str_replace('v2CRM\Sample', 'v2CRM\\'.$class, $model);
                $item_model =   str_replace('class Sample', 'class '.ucfirst($item), $item_model);
                Storage::put("plugins/$name/src/Models/".ucfirst($item).".php", $item_model);
            }
        }

        //create views
        $index_view =   Storage::get('/app/v2CRM/plugin_template/src/views/index.blade.php');
        $index_view =   str_replace('Sample', $class, $index_view);
        Storage::put("plugins/$name/src/views/index.blade.php", $index_view);

        Storage::copy('/app/v2CRM/plugin_template/src/views/widget.blade.php', "plugins/$name/src/views");

        //create route
        $route =   Storage::get('/app/v2CRM/plugin_template/src/routes.php');
        $route =   str_replace('v2CRM\Sample\SampleController', "v2CRM\\".$class."\\".$class."Controller", $route);
        $route =   str_replace("'prefix'=>'sample'", "'prefix'=>'$name'", $route);
        Storage::put("plugins/$name/src/routes.php", $route);
        //create define file
        $define =   Storage::get('/app/v2CRM/plugin_template/src/SamplePlugin.php');
        $define =   str_replace("v2CRM\Sample", "v2CRM\\".$class, $define);
        $define =   str_replace("SamplePlugin", $class."Plugin", $define);
        $define =   str_replace("Sample plugin", $class." Plugin", $define);
        $define =   str_replace("Sample::", $class."::", $define);
        $define =   str_replace("sample", $name, $define);
        if(!empty($request->tables)){
            $tables =   explode(',', $request->tables);
            $table_list =   [];
            foreach($tables as $item){
                $table_list[]   =   "'$item'";
            }
            $define =   str_replace("'table_name'", $table_list, $define);
        }
        Storage::put("plugins/$name/src/".$class."Plugin.php", $define);

        //create ServiceProvider
        $provider =   Storage::get('/app/v2CRM/plugin_template/src/SampleServiceProvider.php');
        $provider =   str_replace("v2CRM\Sample", "v2CRM\\".$class, $provider);
        $provider =   str_replace("SampleServiceProvider", $class."ServiceProvider", $provider);
        $provider =   str_replace("'Sample'", "'$class'", $provider);
        $provider =   str_replace("sample", $name, $provider);

        return v('plugins/success', $name);
    }
}
