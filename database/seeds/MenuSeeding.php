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
                'child' =>  [],
                'url'   =>  '/'
            ],
            [
                'name' => 'Configuration',
                'trans' =>  'system.configuration',
                'icon' => 'fa fa-gears',
                'child' => [
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
                        'path' => 'config/permissions',
                        'name'  =>  'Permissions',
                        'trans' => 'system.permissions'
                    ],
                    [
                        'path' => 'config/permission-table',
                        'name'  =>  'Permission table',
                        'trans' => 'system.permission_role'
                    ]
                ],
                'url' => ''
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
