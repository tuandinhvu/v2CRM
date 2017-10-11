<?php
$mainmenu   =   render_menu(array_merge(menu(1),plugin_menu()));
?>
<ul class="nav navbar-nav">
    @foreach($mainmenu as $menu)
        @if(!empty($menu['child']))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{!empty($menu['trans'])&&\Illuminate\Support\Facades\Lang::exist($menu['trans'])?trans($menu['trans']):$menu['name']}} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    @foreach($menu['child'] as $child)
                    <li><a href="{{$child['path']}}">{{!empty($child['trans'])&&\Illuminate\Support\Facades\Lang::exist($child['trans'])?trans($child['trans']):$child['name']}}</a></li>
                    @endforeach
                </ul>
            </li>
        @else
            <li><a href="{{$menu['url']}}">{{!empty($menu['trans'])&&\Illuminate\Support\Facades\Lang::exist($menu['trans'])?trans($menu['trans']):$menu['name']}}</a></li>
        @endif
    @endforeach
</ul>
