@extends(theme(TRUE).'.layout')

@section('title')
{{trans('auth.login')}}
@endsection

@section('content')
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{trans('auth.need_login')}}</p>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <input type="text" name="id" class="form-control" required placeholder="ID" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" min="6" placeholder="{{trans('auth.password')}}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> {{trans('auth.remember')}}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{trans('auth.login')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <!-- /.social-auth-links -->

            <a href="#">{{trans('auth.forgotpass')}}</a>


        </div>
        <!-- /.login-box-body -->
    </div>
@endsection

@section('js')

@endsection