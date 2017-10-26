<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now    =\Carbon\Carbon::now();
        $permissions    =   [
            [
                'name' => trans('migrations.homepage'),
                'permission' => '/',
                'method' => 'get',
                'type' => 'public',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.groups'),
                'permission' => 'config/groups',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.datagroup'),
                'permission' => 'config/groups/data',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.delgroup'),
                'permission' => 'config/group/del',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.addgroup'),
                'permission' => 'config/groups/create',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.postaddgroup'),
                'permission' => 'config/groups/create',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.editgroup'),
                'permission' => 'config/group/edit',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.posteditgroup'),
                'permission' => 'config/group/edit',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.users'),
                'permission' => 'config/users',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.datausers'),
                'permission' => 'config/users/data',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.deluser'),
                'permission' => 'config/user/del',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.edituser'),
                'permission' => 'config/user/edit',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.postedituser'),
                'permission' => 'config/user/edit',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.adduser'),
                'permission' => 'config/users/create',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.postadduser'),
                'permission' => 'config/users/create',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.branches'),
                'permission' => 'config/branches',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.databranches'),
                'permission' => 'config/branches/data',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.addbranch'),
                'permission' => 'config/branches/create',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.postaddbranch'),
                'permission' => 'config/branches/create',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.editbranch'),
                'permission' => 'config/branch/edit',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.posteditbranch'),
                'permission' => 'config/branch/edit',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.delbranch'),
                'permission' => 'config/branch/del',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.config'),
                'permission' => 'config/system',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.postconfig'),
                'permission' => 'config/system',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.permissions'),
                'permission' => 'config/permissions',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.datapermissions'),
                'permission' => 'config/permissions/data',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.addpermission'),
                'permission' => 'config/permissions/create',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.postaddpermission'),
                'permission' => 'config/permissions/create',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.delpermission'),
                'permission' => 'config/permission/del',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.editpermission'),
                'permission' => 'config/permission/edit',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.posteditpermission'),
                'permission' => 'config/permission/edit',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.routes'),
                'permission' => 'ajax/routes-list',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.roletable'),
                'permission' => 'config/permissions/roletable',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.addgrouppermission'),
                'permission' => 'config/permissions/add-group-permission',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.plugins'),
                'permission' => 'config/plugins',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.installplugin'),
                'permission' => 'config/plugin/{plugin}/install',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.uninstallplugin'),
                'permission' => 'config/plugin/{plugin}/uninstall',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.widgets'),
                'permission' => 'config/widget',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.addwidget'),
                'permission' => 'config/widget/add',
                'method' => 'post',
                'type' => 'private',
                'created_at' => $now,
            ],
            [
                'name' => trans('migrations.delwidget'),
                'permission' => 'config/widget/delete',
                'method' => 'get',
                'type' => 'private',
                'created_at' => $now,
            ]
        ];
        \App\Permission::insert($permissions);

    }
}
