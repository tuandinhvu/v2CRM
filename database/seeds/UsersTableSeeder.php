<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name'  => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'branch_id' => 1,
            'group_id' => 1,
            'api_token' =>  str_random(11),
            'created_at'    =>  \Carbon\Carbon::now()
        ]);
    }
}
