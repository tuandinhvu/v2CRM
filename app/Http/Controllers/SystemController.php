<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function getSystem()
    {
        return v('config.system');
    }

    public function postSystem()
    {
        
    }
}
