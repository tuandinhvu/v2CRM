<?php

namespace App\Http\Controllers;

use App\Option;
use App\Permission;
use App\Plugin;
use Carbon\Carbon;
use Efriandika\LaravelSettings\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
        if(Storage::disk('local')->exists("plugins/$plugin") && Storage::disk('local')->exists("plugins/$plugin/src/".$pluginClass."Plugin.php")){
            $classFullname      =   "\\v2CRM\\$pluginClass\\$pluginClass"."Plugin";
            $data   =   new $classFullname();
            $menu_json  =   json_encode($data->getMenu());
            $option_json    =   json_encode($data->getOptions());
            $mplugin   =   new Plugin();
            $mplugin->name   =   $data->getName();
            $mplugin->folder =   $plugin;
            $mplugin->menu    =   $menu_json;
            $mplugin->options    =   $option_json;
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
                    Permission::find($id)->groups()->attach(explode(',', $item['role']));
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
            Artisan::call("migration --path=plugins/$plugin/src/migrations");
            set_notice(trans('plugins.install_success'),'success');
        }
        else
            set_notice(trans('plugins.plugin_not_found'), 'danger');
        return redirect()->back();
    }
}
