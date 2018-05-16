<?php

namespace v2CRM\Sample;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sample extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
}
