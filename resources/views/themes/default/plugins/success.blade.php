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