@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.index')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('page.index')}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="areaChart" style="height: 250px; width: 1107px;" width="2214"
                            height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection