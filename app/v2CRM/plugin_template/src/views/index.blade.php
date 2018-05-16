@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('Sample::index.title')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('Sample::index.title')}}</h3>

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
        $(document).ready(function(){


        });
    </script>
@endsection