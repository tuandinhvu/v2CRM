<?php

namespace v2CRM\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Posts extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
}
