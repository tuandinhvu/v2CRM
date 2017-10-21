@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('permissions.roletable')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('permissions.roletable')}}</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <?php
                //	                print_r($arr);
                $groups  =   \App\Group::get();
                $countgroup  =   $groups->count();
                ?>
                <table class="table table-striped">
                    <tr>
                        <th colspan="2">BẢNG PHÂN QUYỀN</th>
                        @foreach(\App\Group::all() as $item)
                            <th>{{$item->name}}</th>
                        @endforeach

                    </tr>
                    @foreach($arr as $k=>$v)
                        <tr>
                            <th colspan="{{$countgroup+2}}">{{$k}}</th>
                        </tr>
                        @foreach($v as $i=>$j)
                            <tr>
                                <td>{{$j['name']}}</td>
                                <td>{{$i}}</td>
                                @foreach($groups as $m=>$n)
                                    <td>@if(in_array($n->id,$j['data'])) <input @if($j['type']=='public') disabled @endif id="{{$n->id}}-{{$j['id']}}" type="checkbox" class="check" checked data-group="{{$n->id}}" data-route="{{$j['id']}}" data-action="off" /> @else <input id="{{$n->id}}-{{$j['id']}}"  class="check" type="checkbox" data-group="{{$n->id}}" data-route="{{$j['id']}}" data-action="on" /> @endif</td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{asset('plugins/alertifyjs/css/alertify.css')}}" />
<link rel="stylesheet" href="{{asset('plugins/alertifyjs/css/themes/bootstrap.css')}}" />
@endsection

@section('js')
    <script src="{{asset('plugins/alertifyjs/alertify.js')}}"></script>
    <script>
        $.fn.toggleCheck=function(){
            $(this).prop('checked', !($(this).is(':checked')));
            console.log('a');
        }
        $(function() {

            $('.check').click(function(){
                var group    =   $(this).data('group');
                var route   =   $(this).data('route');
                var action  =   $(this).data('action');
                $.post('{{asset('config/permissions/add-group-permission')}}', {group,route,action, _token:'{{csrf_token()}}'}, function(r){
                    alertify.success('{{trans('permissions.toggle_success')}}');
                    console.log($('#'+group+'-'+route));
                    if(r.code!=0)
                        $('#'+group+'-'+route).toggleCheck();
                });
            });
        });
    </script>
@endsection