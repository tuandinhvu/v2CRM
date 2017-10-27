<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::insert([
            'name'  =>  'Administrator',
            'created_at'    =>  \Carbon\Carbon::now()
        ]);
        Group::insert([
            'name'  =>  'Director',
            'created_at'    =>  \Carbon\Carbon::now()
        ]);
    }
}
