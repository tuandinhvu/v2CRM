<?php

namespace App\Http\Controllers;

use App\Option;
use App\Permission;
use App\Plugin;
use Carbon\Carbon;
use Efriandika\LaravelSettings\Settings;
use Illuminate\Http\Request;
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
}
