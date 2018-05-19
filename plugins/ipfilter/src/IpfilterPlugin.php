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
        return $menu =  [];
    }

    public function getSettings()
    {
        return $settings   =   [
//            'ipfilter' => [
//                'name' => 'default',
//                'label' => trans('Ipfilter::index.default_option'),
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
        return ['accepted_ip'];
    }
}