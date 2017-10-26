<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'name'  =>  'Administrator',
            'created_at'    =>  \Carbon\Carbon::now()
        ]);
        Role::insert([
            'name'  =>  'Director',
            'created_at'    =>  \Carbon\Carbon::now()
        ]);
    }
}
