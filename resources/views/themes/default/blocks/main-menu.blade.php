<?php
$mainmenu   =   render_menu(array_merge(menu(1),plugin_menu()));
?>
<ul class="nav navbar-nav">
    @foreach($mainmenu as $menu)
        @if(!empty($menu['children']))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{!empty($menu['trans'])&&\Illuminate\Support\Facades\Lang::has($menu['trans'])?trans($menu['trans']):$menu['name']}} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    @foreach($menu['children'] as $child)
                    <li><a href="{{asset($child['path'])}}">{{!empty($child['trans'])&&\Illuminate\Support\Facades\Lang::has($child['trans'])?trans($child['trans']):$child['name']}}</a></li>
                    @endforeach
                </ul>
            </li>
        @else
            <li><a href="{{asset($menu['path'])}}">{{!empty($menu['trans'])&&\Illuminate\Support\Facades\Lang::has($menu['trans'])?trans($menu['trans']):$menu['name']}}</a></li>
        @endif
    @endforeach
</ul>
