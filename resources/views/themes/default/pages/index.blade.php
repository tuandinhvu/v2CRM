@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.index')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('page.index')}}</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <div class="box-body" id="mainside">

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    $(document).ready(function(){
    @foreach(\App\Widget::orderBy('order','ASC')->where('position','mainside')->get() as $item)
        @if(p($item->source,'post'))
            load_widget('#mainside', '{{asset($item->source)}}');
        @endif
    @endforeach
    });
@endsection