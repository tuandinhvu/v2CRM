<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(MenuSeeding::class);
        $this->call(OptionSeeder::class);
    }
}
