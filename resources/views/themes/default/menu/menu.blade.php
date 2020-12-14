@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.menumanagement')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.menumanagement')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'btn btn-sm btn-primary'],'')  !!}
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group">
                        <div class="input-group" style="margin-left: 10px">
                            <div class="input-group-addon"><b>Tên menu:</b> </div>
                            <input type="text" class="form-control" id="menu-name" placeholder="{{trans('menu.nameplacehold')}}" value="{{$data->name}}">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="dd">
                            <ol class="dd-list list-1">
                                <?php $index = 0; ?>
                                @foreach(json_decode($data->data, true) as $item)
                                        <?php $index++; ?>
                                    <li class="dd-item" id="li-{{$index}}" data-name="{{$item['name']}}" data-trans="{{$item['trans']}}" data-path="{{$item['path']}}">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content" id='dd3-{{$index}}'>@if(!empty(trans($item['trans']))) {{trans($item['trans'])}} @else {{$item['name']}} @endif <a type="button" class="btn btn-xs pull-right btn-edit" id="{{$index}}" data-name="{{$item['name']}}" data-trans="{{$item['trans']}}" data-path="{{$item['path']}}" style="">Sửa</a> <a class="btn btn-xs pull-right btn-delete" id="{{$index}}" style="">Xóa</a></div>
                                        <ol class="dd-list">
                                            @if(!empty($item['children']))
                                                @foreach($item['children'] as $i)
                                                    <?php $index++; ?>
                                                    @if(!empty($i['name']))
                                                        <li class="dd-item" id="li-{{$index}}" data-name="{{$i['name']}}" data-trans="{{$i['trans']}}" data-path="{{$i['path']}}">
                                                            <div class="dd-handle dd3-handle"></div>
                                                            <div class="dd3-content" id='dd3-{{$index}}'>@if(!empty(trans($i['trans']))) {{trans($i['trans'])}} @else {{$i['name']}} @endif <a class="btn btn-xs pull-right btn-edit" id="{{$index}}" data-name="{{$i['name']}}" data-trans="{{$i['trans']}}" data-path="{{$i['path']}}" style="">Sửa</a> <a class="btn btn-xs pull-right btn-delete" id="{{$index}}" style="">Xóa</a></div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ol>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="form-group col-md-12 menu-footer" style="text-align:center;">
                        <button class="btn btn-info btn-sm btn-add">{{trans('system.add')}}</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-save-menu">{{trans('system.submit')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('system.edit-menu')}}</h4>
                </div>
                <div class="modal-body">
                    <input class="i-id" value="" hidden>
                    <label class="control-label">{{trans('page.menupath')}}</label>
                    <div id="pathinput">
                        <input type="text" class="form-control path-edit" name="path" placeholder="{{trans('page.pathedit')}}"  value=""/>
                    </div>

                    <label class="control-label">{{trans('page.menuname')}}</label>
                    <input type="text" class="form-control name-edit" name="name" placeholder="{{trans('page.nameedit')}}"  value=""/>

                    <label class="control-label">{{trans('page.menutrans')}}</label>
                    <input type="text" class="form-control trans-edit" name="trans" placeholder="{{trans('page.transedit')}}"  value=""/>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal">{{trans('system.cancel')}}</a>
                    <a type="submit" class="btn btn-info btn-save" data-id="" data-dismiss="modal">{{trans('system.submit')}}</a>
                </div>
            </div>

        </div>
    </div>

    <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('system.add-menu')}}</h4>
                </div>
                <div class="modal-body">
                    <input class="i-id" value="" hidden>
                    <label class="control-label">{{trans('page.menupath')}}</label>
                    <div id="pathinput">
                        <input type="text" class="form-control path-add" name="path" placeholder="{{trans('page.pathedit')}}"  value=""/>
                    </div>

                    <label class="control-label">{{trans('page.menuname')}}</label>
                    <input type="text" class="form-control name-add" name="name" placeholder="{{trans('page.nameedit')}}"  value=""/>

                    <label class="control-label">{{trans('page.menutrans')}}</label>
                    <input type="text" class="form-control trans-add" name="trans" placeholder="{{trans('page.transedit')}}"  value=""/>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal">{{trans('system.cancel')}}</a>
                    <a type="submit" class="btn btn-info btn-save" data-id="" data-dismiss="modal">{{trans('system.submit')}}</a>
                </div>
            </div>

        </div>
    </div>
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
    <style type="text/css">
        div.token-input-dropdown-bootstrap {
            position: absolute;
            width: 400px;
            background-color: #fff;
            overflow: hidden;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            cursor: default;
            z-index: 11001;
        }
        li.token-input-token {
            max-width: 100% !important;
        }
        .form-inline .form-group {
            margin-bottom: 10px !important;
            margin-top: 10px !important;
        }
        .cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
        * html .cf { zoom: 1; }
        *:first-child+html .cf { zoom: 1; }

        .small { color: #666; font-size: 0.875em; }
        .large { font-size: 1.25em; }
        /**
         * Nestable
         */
        .dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }
        .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
        .dd-list .dd-list { padding-left: 30px; }
        .dd-collapsed .dd-list { display: none; }
        .dd-item,
        .dd-empty,
        .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
        .dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd-handle:hover { color: #2ea8e5; background: #fff; }
        .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
        .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
        .dd-item > button[data-action="collapse"]:before { content: '-'; }
        .dd-placeholder,
        .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
        .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }
        .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
        .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        }
        /**
         * Nestable Extras
         */
        .nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }
        #nestable-menu { padding: 0; margin: 20px 0; }
        #nestable-output,
        #nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }
        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background:         linear-gradient(top, #bbb 0%, #999 100%);
        }
        #nestable2 .dd-handle:hover { background: #bbb; }
        #nestable2 .dd-item > button:before { color: #fff; }
        @media only screen and (min-width: 700px) {
            .dd { float: left; width: 48%; }
            .dd + .dd { margin-left: 2%; }
        }
        .dd-hover > .dd-handle { background: #2ea8e5 !important; }
        /**
         * Nestable Draggable Handles
         */
        .dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd3-content:hover { color: #2ea8e5; background: #fff; }
        .dd-dragel > .dd3-item > .dd3-content { margin: 0; }
        .dd3-item > button { margin-left: 30px; }
        .dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:         linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
        .dd3-handle:hover { background: #ddd; }
        /**
         * Socialite
         */
        .socialite { display: block; float: left; height: 35px; }
    </style>
@endsection

@section('js')
    <script src="{{asset('plugins/nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}" ></script>
    <script>
        $(function() {
            nestable = $('.dd').nestable({ maxDepth: '2' });

            // console.log(window.JSON.stringify(nestable.nestable('serialize')));
            $('.dd').on('change', function() {
                /* on change event */
            });

            $(document).on('click', '.btn-save-menu', function(e){
                var data = window.JSON.stringify(nestable.nestable('serialize'));
                var name = $('.form-group #menu-name').val();
                $.get('<?php echo asset('config/menu/data?id='.request('id')); ?>', {data: data, name, _token: '{{csrf_token()}}'}, function(r){
                    window.location.reload();
                });
            });

            $('.dd').on('click', '.btn-edit', function(){
                var path    =   $(this).data('path');
                var name    =   $(this).data('name');
                var trans   =   $(this).data('trans');
                var id      =   $(this).attr('id');

                // console.log(id);

                $('.modal .i-id').val(id);
                $('.name-edit').val(name);
                $('.trans-edit').val(trans);
                $('#myModal').modal('show');
                $('.path-edit').tokenInput("{{asset('/ajax/routes-list')}}", {
                    theme: "bootstrap",
                    queryParam: "term",
                    zindex  :   9999,
                    tokenLimit  :   1,
                    onAdd   :   function(r){
                        $('#method').val(r.method);
                    },
                    prePopulate: [
                        {id: path, name: path}
                    ]
                });
            });

            $('.menu-footer').on('click', '.btn-add', function(){

                $('#myModal2').modal('show');
                $('.path-add').tokenInput("{{asset('/ajax/routes-list')}}", {
                    theme: "bootstrap",
                    queryParam: "term",
                    zindex  :   9999,
                    tokenLimit  :   1,
                    onAdd   :   function(r){
                        $('#method').val(r.method);
                    }
                });
            });

            $('#myModal2').on('click','.btn-save', function () {
                {{$index++}}
                var name = $('.name-add').val();
                var trans = $('.trans-add').val();
                var path = $('.path-add').val();

                $('.list-1').append("<li class=\"dd-item\" id=\"li-{{$index}}\" data-name=\""+name+"\" data-trans=\""+ trans+"\" data-path=\""+path+"\">\n" +
                    "                                                            <div class=\"dd-handle dd3-handle\">Drag</div>\n" +
                    "                                                            <div class=\"dd3-content\" id='dd3-{{$index}}'>"+name+"<a class=\"btn btn-xs pull-right btn-edit\" id=\"{{$index}}\" data-name=\""+name+"\" data-trans=\""+trans+"\" data-path=\""+path+"\" style=\"\">Sửa</a> <a class=\"btn btn-xs pull-right btn-delete\" id=\"{{$index}}\" style=\"\">Xóa</a></div>\n" +
                    "                                                        </li>");
            });

            $('.dd').on('click', '.btn-delete', function(){
                console.log($('.dd').find('#li-'+$(this).attr('id')));
                $('.dd').find('#li-'+$(this).attr('id')).remove();
            });

            $('#myModal').on('click','.btn-save', function () {
                var id  = $('#myModal .i-id').val();

                // console.log($('.dd').find('#li-'+id).data('name'));
                // console.log($('.name-edit').val());

                $('.dd').find('#li-'+id).data('path',$('.path-edit').val());
                $('.dd').find('#li-'+id).data('name',$('.name-edit').val());
                $('.dd').find('#li-'+id).data('trans',$('.trans-edit').val());

                $('.dd').find('#'+id).data('path',$('.path-edit').val());
                $('.dd').find('#'+id).data('name',$('.name-edit').val());
                $('.dd').find('#'+id).data('trans',$('.trans-edit').val());

                $('.dd').find('#dd3-'+id).html($('.name-edit').val()+'<a class="btn btn-xs pull-right btn-edit" id="'+id+'" data-name="'+$('.name-edit').val()+'" data-trans="'+$('.trans-edit').val()+'" data-path="'+$('.path-edit').val()+'" style="">Sửa</a> <a class="btn btn-xs pull-right" style="">Xóa</a>');
            });

            $('#myModal').on('hidden.bs.modal', function (e) {
                $('#myModal #pathinput').html("<input type=\"text\" class=\"form-control path-edit\" name=\"path\" placeholder=\"{{trans('page.pathedit')}}\"  value=\"\"/>");
            });

            $('#myModal2').on('hidden.bs.modal', function (e) {
                $('#myModal2 #pathinput').html("<input type=\"text\" class=\"form-control path-add\" name=\"path\" placeholder=\"{{trans('page.pathedit')}}\"  value=\"\"/>");
                $('#myModal2 .name-add').val('');
                $('#myModal2 .trans-add').val('');
            });
        });
    </script>
@endsection
