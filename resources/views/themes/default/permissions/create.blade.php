@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.createpermission')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.createpermission')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('config/permissions', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
                    </div>
                </div>
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('permissions.name')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="{{trans('permissions.nameplacehold')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('permissions.permission')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="permission" id="permission" placeholder="{{trans('permissions.permission')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('permissions.method')}}</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="method" id="method">
                                    <option value="get">GET</option>
                                    <option value="post">POST</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('permissions.type')}}</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="type">
                                    <option value="public">{{trans('g.public')}}</option>
                                    <option value="private">{{trans('g.private')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('users.group')}}</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="groups" multiple>
                                    @foreach(\App\Group::all() as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">{{trans('system.cancel')}}</button>
                        <button type="submit" class="btn btn-info pull-right">{{trans('system.submit')}}</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
@endsection

@section('js')
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script>
        $(function() {
            $('#permission').tokenInput("{{asset('/ajax/routes-list')}}", {
                theme: "bootstrap",
                queryParam: "term",
                zindex  :   1005,
                tokenLimit  :   1,
                onAdd   :   function(r){
                    $('#method').val(r.method);
                }
            });
        });
    </script>
@endsection