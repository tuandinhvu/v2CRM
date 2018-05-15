@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.createuser')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.createplugin')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('config/plugins', '', '<i class="fa fa-arrow-left"></i> '.trans('system.back'), ['class'=>'btn btn-sm btn-success'],'')  !!}
                    </div>
                </div>
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('plugins.name')}}</label>

                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon"><strong>v2crm/</strong></div>
                                    <input class="form-control" name="name" placeholder="sample" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{trans('plugins.description')}}</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="description" placeholder="" />
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