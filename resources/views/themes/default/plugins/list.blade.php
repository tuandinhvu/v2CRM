@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.pluginlist')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.pluginlist')}}</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <div class="list-group">
                        @foreach($plugin_list as $item)
                            <div href="javascript:;" class="list-group-item col-md-6">
                                <div class="col-md-12 row">
                                    <span class="pull-left" style="margin-right: 10px"><i class="{{$item['icon']}} fa-3x"></i></span>
                                    <div class="pull-left" style="cursor: pointer" onclick="return window.location.replace('{{asset($item['mainroute'])}}')">

                                        <h4 class="list-group-item-heading">{{$item['name']}}</h4>
                                        <p class="list-group-item-text">{{$item['description']}}</p>
                                    </div>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-<?php echo $item['installed']==TRUE?'success':'default'; ?> dropdown-toggle" data-toggle="dropdown">
                                                <?php echo $item['installed']==TRUE?"<i style='color:white' class='fa fa-check'></i> Đã cài đặt":'Chưa cài đặt'; ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                @if($item['installed']==TRUE)
                                                    <li><a href="javascript:;">Cài lại</a></li>
                                                    <li><a href="javascript:;">Gỡ cài đặt</a></li>
                                                @else
                                                    <li><a href="{{asset('plugin/'.$item['folder'].'/install')}}">Cài đặt</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {

        });
    </script>
@endsection