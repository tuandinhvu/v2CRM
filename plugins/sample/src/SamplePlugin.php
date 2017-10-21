<?php
namespace v2CRM\Sample;
use App\v2CRM\PluginInterface;

/**
 * Created by PhpStorm.
 * User: Windows 10 Version 2
 * Date: 7/9/2017
 * Time: 5:01 PM
 */
class SamplePlugin implements PluginInterface {

    public function getName()
    {
        return 'Sample plugin';
    }

    public function getMenu()
    {
        return $menu =  [
            [
                'path' => 'sample',
                'name' => trans('Sample::index.plugin_name'),
                'role'  =>  '1',
                'method'    =>  'get',
                'menu'  =>  TRUE
            ]
        ];
    }

    public function getSettings()
    {
        return $settings   =   [
            'sample' => [
                'name' => 'default',
                'label' => trans('Sample::index.default_option'),
                'type'  =>  'text',
                'default'   =>  'default option',
                'values'    =>  ''
            ]
        ];
    }

    public function getOptions()
    {
       return [];
    }
}