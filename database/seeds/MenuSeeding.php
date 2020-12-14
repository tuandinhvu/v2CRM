<?php

use Illuminate\Database\Seeder;

class MenuSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu   =   [
            [
                'name'  =>  'Home',
                'trans' =>  'system.homepage',
                'icon'  =>  'fa fa-home',
                'path'   =>  '/'
            ],
            [
                'name' => 'Configuration',
                'trans' =>  'system.configuration',
                'children' => [
                    [
                        'path' => 'config/system',
                        'name'  =>  'Settings',
                        'trans' => 'system.system'
                    ],
                    [
                        'path' => 'config/plugins',
                        'name'  =>  'Plugins',
                        'trans' => 'system.plugins'
                    ],
                    [
                        'path' => 'config/ipaccess',
                        'name'  =>  'IP Access',
                        'trans' => 'system.ipaccess'
                    ],
                    [
                        'path' => 'config/users',
                        'name'  =>  'Users',
                        'trans' => 'system.users'
                    ],
                    [
                        'path' => 'config/groups',
                        'name'  =>  'User groups',
                        'trans' => 'system.groups'
                    ],
                    [
                        'path' => 'config/branches',
                        'name'  =>  'Branches list',
                        'trans' => 'system.branches'
                    ],
                    [
                        'path' => 'config/permissions/roletable',
                        'name'  =>  'Bảng phân quyền',
                        'trans' => 'permission.permission_role'
                    ],
                    [
                        'path' => 'config/widget',
                        'name'  =>  'Widget manager',
                        'trans' => 'system.widget'
                    ]
                ],
                'path' => ''
            ]
        ];
        \App\Menu::insert([
            'name'  =>  'Main menu',
            'data'  =>  json_encode($menu),
            'created_at'    =>  Carbon\Carbon::now(),
            'options'   =>  '{}'
        ]);
    }
}
