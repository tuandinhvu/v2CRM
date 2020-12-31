<?php
namespace v2CRM\Post;
use App\v2CRM\PluginInterface;

/**
 * Created by PhpStorm.
 * User: Windows 10 Version 2
 * Date: 7/9/2017
 * Time: 5:01 PM
 */
class PostPlugin implements PluginInterface {

    public function getName()
    {
        return 'Post Plugin';
    }

    public function getMenu()
    {
        return $menu =  [
            [
                'path' => 'post',
                'name' => trans('Post::index.plugin_name'),
                'role'  =>  '1',
                'method'    =>  'get',
                'menu'  =>  TRUE
            ]
        ];
    }

    public function getSettings()
    {
        return $settings   =   [
//            'post' => [
//                'name' => 'default',
//                'label' => trans('Post::index.default_option'),
//                'type'  =>  'text',
//                'default'   =>  'default option',
//                'values'    =>  ''
//            ]
        ];
    }

    public function getOptions()
    {
       return [];
    }

    public function getTablename()
    {
        return ['categories','posts','tags','post_tag'];
    }
}