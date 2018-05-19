<?php

namespace v2CRM\Ipfilter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Accepted_ip extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
}
