@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('permissions.roletable')}}
@endsection

@section('content')
    <?php
    //	                print_r($arr);
    $groups  =   \App\Group::get();
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('permissions.unRegisted')}}</h3>

                <div class="box-tools pull-right">
                {!!  a('config/permissions','', '<i class="fa fa-arrow-right"></i> Chuyển đến phân quyền thành viên', ['class'=>'btn btn-sm btn-primary'])!!}
                </div>
            </div>
            <div class="box-body">

                <table class="table table-striped">
                    <tr>
                        <th>URI</th>
                        <th>{{trans('permissions.name')}}</th>
                        <th>{{trans('permissions.method')}}</th>
                        @foreach(\App\Group::all() as $item)
                            <th>{{$item->name}}</th>
                        @endforeach
                        <th></th>
                    </tr>
                    @foreach($unRegistedRoutes as $k=>$v)
                    <tr>
                        <th class="peruri">{{$v['permission']}}</th>
                        <td><input class="form-control pername" /> </td>
                        <td class="permethod">{{$v['method']}}</td>
                        @foreach(\App\Group::all() as $item)
                            <td><input type="checkbox" class="hasPer-{{$k}}" data-id="{{$item->id}}" /></td>
                        @endforeach
                        <th>
                            <a class="btn btn-sm btn-primary add-permission" data-id="{{$k}}">Tạo quyền</a>
                        </th>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('permissions.roletable')}}</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body">
                <?php
                $countgroup  =   $groups->count();
                ?>
                <table class="table table-striped">
                    <tr>
                        <th colspan="2"></th>
                        @foreach(\App\Group::all() as $item)
                            <th>{{$item->name}}</th>
                        @endforeach

                    </tr>
                    <tbody id="permissionList">
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

                    </tbody>

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

            $('.add-permission').click(function(){
                var row =   $(this).closest('tr');
                k   =   $(this).data('id');
                uri =   row.find('.peruri').html();
                name =  row.find('.pername').val();
                method = row.find('.permethod').html();
                groups = new Array();
                $('.hasPer-'+k+':checked').each(function(k,v){
                    groups.push(v.dataset.id);
                });
                $.post('{{route('permission.create')}}', {name,permission: uri,method,type:'private', groups, _token: '{{csrf_token()}}'}, function(r){
                    checkboxs   =   "";
                    $('.hasPer-'+k).each(function(k,v){
                        checkboxs+="<td>"+v.outerHTML+"</td>";
                        console.log(v);
                    });
                    $('#permissionList').append("<tr>\n" +
                        "                            <th colspan=\"{{$countgroup+2}}\">"+uri+"</th>\n" +
                        "                        </tr><tr>\n" +
                        "                                <td>"+name+"</td>\n" +
                        "                                <td>"+method+"</td>\n" +checkboxs +
                        "          </tr>");
                        row.remove();
                });
            });
        });
    </script>
@endsection
