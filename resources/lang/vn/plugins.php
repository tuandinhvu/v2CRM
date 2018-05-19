<?php
/**
 * Created by PhpStorm.
 * User: tuan3
 * Date: 10/23/2017
 * Time: 9:11 AM
 */
return [
    'install_success' => 'Cài đặt thành công',
    'plugin_not_found' => 'Không tìm thấy plugin phù hợp',
    'uninstall_success' => 'Gỡ cài đặt thành công!',
    'createplugin' => 'Trình tạo plugin',
    'name' => 'Tên plugins',
    'description' => 'Mô tả',
    'tables' => 'Tên các bảng',
    'tables_placeholder' => 'Tên bảng cần tạo, ngăn cách nhau bằng dấu phẩy (,)',
    'advanced_settings' => 'Thêm tuỳ chọn',
    'type' => 'Loại',
    'license' => 'Giấy phép',
    'icon' => 'Biểu tượng',
    'create' => [
        'follow'    =>  'Vui lòng làm theo các bước sau đây:',
        'installation'  =>  'Cài đặt',
        'headline' => 'Plugin :Name đã được tạo thành công!',
        'first' => '1. Mở file composer.json, thêm dòng sau đây vào mục autoload\psr-4: ',
        'composer' => '"v2CRM\\\\:Name\\\\": "plugins/:name/src"',
        'dumpautoload' => 'Sau đó chạy lệnh <b>composer dumpautoload</b>',
        'second' => '2. Mở file /config/app.php, thêm dòng sau vào mục Providers: ',
        'provider' => 'v2CRM\:Name\:NameServiceProvider::class',
        'enjoy' =>  'Hãy truy cập url: <a href=":url">:url</a> để xem kết quả!',
        'develop' =>  'Phát triển'
    ]
];