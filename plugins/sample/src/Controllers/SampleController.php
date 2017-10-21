<?php
namespace v2CRM\Sample;

use App\Http\Controllers\Controller;

class SampleController extends Controller{

    public function getIndex()
    {
        return view('Sample::index');
    }
}