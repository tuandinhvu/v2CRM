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
                    <ul class="nav nav-pills nav-tabs">
                        @foreach($categories as $item)
                        <li class="{{request('source','system')==$item['source']?'active':''}}"><a href="{{asset('config/system?source='.$item['source'])}}">{{$item['name']}}</a></li>
                        @endforeach
                    </ul>
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
                            <button type="submit" class="btn btn-primary pull-right">{{trans('system.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection