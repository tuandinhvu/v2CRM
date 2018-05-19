<?php
namespace v2CRM\Ipfilter;

use App\Http\Controllers\Controller;

class IpfilterController extends Controller{

    public function getIndex()
    {
        return view('Ipfilter::index');
    }

    public function postWidget()
    {
        return view('Ipfilter::widget');
    }
}