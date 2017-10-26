<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options    =   [
            [
                'name'  =>  'loginas',
                'label' =>  'Đăng nhập bằng',
                'type'  =>  'checkbox',
                'source'    =>  'system',
                'values'    =>  json_encode([
                    [
                        'value'  =>  'id',
                        'label' =>  'ID'
                    ],
                    [
                        'value' =>  'email',
                        'label' =>  'Email'
                    ]
                ]),
                'created_at'    =>  Carbon\Carbon::now(),
                'default'   =>  json_encode(['id','email'])
            ],
            [
                'name'  =>  'sitename',
                'label' =>  'Tiêu đề hệ thống',
                'type'  =>  'text',
                'source'    =>  'system',
                'values'    =>  json_encode([]),
                'created_at'    =>  Carbon\Carbon::now(),
                'default'   =>  'Site name'
            ],
            [
                'name'  =>  'footer',
                'label' =>  'Footer text',
                'type'  =>  'text',
                'source'    =>  'system',
                'values'    =>  json_encode([]),
                'created_at'    =>  Carbon\Carbon::now(),
                'default'   =>  'Copyright v2CRM. Allright Reserved'
            ]
        ];
        \App\Option::insert($options);
        foreach($options as $item){
            \Settings::set($item['source'].'_'.$item['name'], $item['default']);
        }
    }
}
