@extends(theme(TRUE).'.layout')

@section('title')
    {{trans('Ipfilter::index.title')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('Ipfilter::index.title')}}</h3>

                    <div class="box-tools pull-right">
                        {!! a('config/permissions/create', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'btn btn-sm btn-primary'],'')  !!}
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{trans('Ipfilter::index.ip')}}</th>
                            <th>{{trans('Ipfilter::index.description')}}</th>
                            <th>{{trans('Ipfilter::index.revoke_at')}}</th>
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
        $(document).ready(function(){
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! asset('ipfilter/data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'ip_address', name: 'ip_address' },
                    { data: 'description', name: 'description' },
                    { data: 'revoke_at', name: 'revoke_at' },
                    { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                ]
            });

        });
    </script>
@endsection