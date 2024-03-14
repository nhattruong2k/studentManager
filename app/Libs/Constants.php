<?php 

namespace App\Libs;

class Constants
{
    public static $list_numpaging = [
        '10' => 10,
        '15' => 15,
        '20' => 20,
        '30' => 30,
        '50' => 50,
        '100' => 100,
        '200' => 200
    ];

    public static $status = [
        'active' => 1,
        'deactive' => 0,
    ];

    public static $is_visible = [
        'active' => 1,
        'deactive' => 0,
    ];

    public static $image_default = 'default.jpg';

    public static $administrator = 'administrator';
}