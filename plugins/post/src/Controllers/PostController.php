<?php
namespace v2CRM\Post;

use App\Http\Controllers\Controller;

class PostController extends Controller{

    public function getIndex()
    {
        return view('Post::index');
    }

    public function postWidget()
    {
        return view('Post::widget');
    }
}