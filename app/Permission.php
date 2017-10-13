<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function group() {
        return $this->belongsToMany('\App\Group');
    }
    public function type() {
        return $this->type=='public'?'Công cộng':'Cần phân quyền';
    }
}
