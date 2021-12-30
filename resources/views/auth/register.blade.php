<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('auth.library')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ route('home') }}"><b>{{__('auth.library')}}</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">{{__('auth.register_title')}}</p>

    <form action="{{ route('register') }}" method="post" id="myform">
        {{ csrf_field() }}
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="{{__('auth.name')}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
          @if ($errors->has('name'))
              <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
          @endif
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="{{__('auth.email')}}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
              <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
          @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" name = "password" placeholder="{{__('auth.password')}}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password'))
              <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
          @endif
      </div>
      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" name="password_confirmation"  placeholder="{{__('auth.re_password')}}">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          @if ($errors->has('password_confirmation'))
              <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
          @endif
      </div>
        <div class="row  has-feedback">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label  class="form-group {{ $errors->has('terms') ? ' has-error' : '' }}">
              <input type="checkbox" {{ !old('terms') ?: 'checked' }} name="terms"> {{__('auth.agree_term')}} <a href="#">{{__('auth.terms')}}</a>
                @if ($errors->has('terms'))

                    <span class="help-block">
                    <strong>{{ $errors->first('terms') }}</strong>
                    </span>

                @endif
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{__('auth.register')}}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ route('login') }}" class="text-center">{{__('auth.login_hint_on_reg')}}</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script  type =" text/javascript " src =" {{ asset('vendor/jsvalidation/js/jsvalidation.js')}} "> </script >
{!! $validator->selector("#myform") !!}
</body>
</html>
