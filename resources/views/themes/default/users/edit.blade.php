@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.editeuser')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.editeuser')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('config/users', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
                    </div>
                </div>
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('users.name')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="{{trans('users.nameplacehold')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('users.email')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" placeholder="{{trans('users.emailplacehold')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('users.password')}}</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="{{trans('users.passwordplacehold')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('users.group')}}</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="group_id">
                                    @foreach(\App\Group::get() as $gr)
                                        <option value="{{$gr->id}}">{{$gr->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('users.branch')}}</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="branch_id">
                                    @foreach(\App\Branch::get() as $br)
                                        <option value="{{$br->id}}">{{$br->name}}</option>
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
@endsection

@section('js')
    <script>
        $(function() {

        });
    </script>
@endsection