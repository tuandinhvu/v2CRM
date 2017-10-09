<?php

use App\Branch;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::insert([
            'name'  =>  'Văn phòng',
            'is_head'   =>  TRUE
        ]);
    }
}
