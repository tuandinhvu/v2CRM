@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.widget')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.widget')}}</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">{{trans('system.leftside')}}</div>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                    @foreach($data['leftside'] as $item)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                                   {{$item->name}}
                                                </a>
                                                <a class="btn btn-primary btn-xs pull-right" href="{{asset('config/widget/delete?id='.$item->id)}}"><i class="fa fa-times"></i></a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$item->id}}" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="heading{{$item->id}}">
                                            <div class="panel-body">
                                                <form method="post" action="{{asset('config/widget/edit/'.$item->id)}}">
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.name')}}</label>
                                                        <input type="text" name="name" class="form-control" value="{{$item->name}}" placeholder="{{trans('widgets.nameplacehold')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.order')}}</label>
                                                        <input type="number" name="order" class="form-control"  value="{{$item->order}}" placeholder="{{trans('widgets.order')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.source')}}</label>
                                                        <input type="text" name="source" class="form-control" id="source-{{$item->id}}" value="{{$item->source}}"  placeholder="{{trans('widgets.source')}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-default">{{trans('g.submit')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function(){
                                                $('#source-{{$item->id}}').tokenInput("{!! asset('/ajax/routes-list?type=widget&hideinfo=1&method=post') !!}", {
                                                    theme: "bootstrap",
                                                    queryParam: "term",
                                                    zindex  :   1005,
                                                    tokenLimit  :   1,
                                                    prePopulate: [
                                                        {id: "{{$item->source}}", name: "{{$item->source}}"}
                                                    ]
                                                });
                                            });
                                        </script>
                                    </div>

                                    @endforeach
                                    <div class="panel panel-info">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseNew" aria-expanded="true" aria-controls="collapseNew">
                                                    <i class="fa fa-plus"></i> {{trans('widgets.new_widget')}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseNew" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <form method="post" action="{{asset('config/widget/add')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="position" value="leftside" />
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.name')}}</label>
                                                        <input type="text" name="name" class="form-control"  placeholder="{{trans('widgets.nameplacehold')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.order')}}</label>
                                                        <input type="number" name="order" class="form-control"  placeholder="{{trans('widgets.order')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.source')}}</label>
                                                        <input type="text" name="source" class="form-control source"  placeholder="{{trans('widgets.source')}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-default">{{trans('g.submit')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">{{trans('system.mainside')}}</div>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    @foreach($data['mainside'] as $item)
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                                        {{$item->name}}
                                                    </a>
                                                    <a class="btn btn-primary btn-sm" href="{{asset('config/widget/delete?id='.$item->id)}}"
                                                </h4>
                                            </div>
                                            <div id="collapse{{$item->id}}" class="panel-collapse collapse" role="tabpanel"
                                                 aria-labelledby="heading{{$item->id}}">
                                                <div class="panel-body">
                                                    <form method="post" action="{{asset('config/widget/edit?id='.$item->id)}}">
                                                        <div class="form-group">
                                                            <label>{{trans('widgets.name')}}</label>
                                                            <input type="text" name="name" class="form-control"  placeholder="{{trans('widgets.nameplacehold')}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{trans('widgets.order')}}</label>
                                                            <input type="number" name="order" class="form-control"  placeholder="{{trans('widgets.order')}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{trans('widgets.source')}}</label>
                                                            <input type="text" name="source" id="source-{{$item->id}}" class="form-control"  placeholder="{{trans('widgets.source')}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-default">{{trans('g.submit')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#source-{{$item->id}}').tokenInput("{!! asset('/ajax/routes-list?type=widget&hideinfo=1&method=post') !!}", {
                                                        theme: "bootstrap",
                                                        queryParam: "term",
                                                        zindex  :   1005,
                                                        tokenLimit  :   1,
                                                        prePopulate: [
                                                            {id: "{{$item->source}}", name: "{{$item->source}}"}
                                                        ]
                                                    });
                                                });
                                            </script>
                                        </div>

                                    @endforeach
                                    <div class="panel panel-info">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseNew2" aria-expanded="true" aria-controls="collapseNew2">
                                                    <i class="fa fa-plus"></i> {{trans('widgets.new_widget')}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseNew2" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <form method="post" action="{{asset('config/widget/add')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="position" value="mainside" />
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.name')}}</label>
                                                        <input type="text" name="name" class="form-control"  placeholder="{{trans('widgets.nameplacehold')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.order')}}</label>
                                                        <input type="number" name="order" class="form-control"  placeholder="{{trans('widgets.order')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('widgets.source')}}</label>
                                                        <input type="text" name="source" class="form-control source"  placeholder="{{trans('widgets.source')}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-default">{{trans('g.submit')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
@endsection

@section('js')
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script>
        $(function() {
            $('.source').tokenInput("{!! asset('/ajax/routes-list?type=widget&hideinfo=1&method=post') !!}", {
                theme: "bootstrap",
                queryParam: "term",
                zindex  :   1005,
                tokenLimit  :   1
            });
        });
    </script>
@endsection