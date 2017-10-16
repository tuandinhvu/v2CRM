@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.config')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.config')}}</h3>

                    <div class="box-tools pull-right">
                    
                    </div>
                </div>
                <div class="box-body">
                    <form method="post">
                        {{csrf_field()}}
                        @foreach($options as $item)
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{$item['label']}}</label>

                                    <div class="col-sm-10">
                                        {!! opt_input($item['name'],$item['type'],$item['values']) !!}
                                    </div>
                                </div>

                            </div>
                    @endforeach
                    <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">{{trans('system.cancel')}}</button>
                            <button type="submit" class="btn btn-info pull-right">{{trans('system.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection