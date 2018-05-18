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
                    <h3>{{trans('plugins.create.headline', ['name'=>$name])}}</h3>
                    <h3><b>I. {{trans('plugins.create.installation')}}</b></h3>
                    <p><b>{{trans('plugins.create.follow')}}</b></p>
                    <h4>{{trans('plugins.create.first')}}</h4>
                    <code>
                        {{trans('plugins.create.composer', ['name'=>$name])}}
                    </code>
                    <br/>
                    <br/>
                    <p>{!! trans('plugins.create.dumpautoload') !!}</p>
                    <h4>{{trans('plugins.create.second')}}</h4>
                    <code>
                        {{trans('plugins.create.provider', ['name'=>$name])}}
                    </code>
                    <br/>
                    <br/>
                    <p><b>{!! trans('plugins.create.enjoy', ['url'=>asset($name)]) !!}</b></p>

                    <h3><b>II. {{trans('plugins.create.develop')}}</b></h3>
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