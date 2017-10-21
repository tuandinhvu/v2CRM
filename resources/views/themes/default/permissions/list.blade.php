@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('page.permissionlist')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('page.permissionlist')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('config/permissions/create', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'btn btn-sm btn-primary'],'')  !!}
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{trans('permissions.name')}}</th>
                            <th>{{trans('permissions.permission')}}</th>
                            <th>{{trans('permissions.method')}}</th>
                            <th>{{trans('permissions.type')}}</th>
                            <th>{{trans('g.manage')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! asset('config/permissions/data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'permission', name: 'permission' },
                    { data: 'method', name: 'method' },
                    { data: 'typename', name: 'typename' },
                    { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                ]
            });
        });
    </script>
@endsection