<?php
namespace v2CRM\Ipfilter;
use App\v2CRM\PluginInterface;

/**
 * Created by PhpStorm.
 * User: Windows 10 Version 2
 * Date: 7/9/2017
 * Time: 5:01 PM
 */
class IpfilterPlugin implements PluginInterface {

    public function getName()
    {
        return 'Ipfilter Plugin';
    }

    public function getMenu()
    {
        return $menu = [
            [
                'path' => 'ipfilter',
                'name' => trans('Ipfilter::index.plugin_name'),
                'role' => '1',
                'method' => 'get',
                'menu' => FALSE
            ]

        ];
    }

    public function getSettings()
    {
        return $settings   =   [
            'ipfilter' => [
                'name' => 'default',
                'label' => trans('Ipfilter::index.default_option'),
                'type'  =>  'url',
                'default'   =>  'default option',
                'values'    =>  'ipfilter'
            ]
        ];
    }

    public function getOptions()
    {
       return [];
    }

    public function getTablename()
    {
        return ['accepted_ip', 'whitelist_ip'];
    }
}