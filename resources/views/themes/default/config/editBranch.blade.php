@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.editbranch')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.editbranch')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('config/branches', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
                    </div>
                </div>
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('branches.name')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="{{trans('branches.nameplacehold')}}" value="{{old('name', !empty($data->name)?$data->name:'')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-10">
                                <input type="checkbox" name="is_head" value="1" @if($data->is_head==1) checked @endif /> {{trans('branches.is_head')}}
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