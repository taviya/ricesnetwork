<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css?v=3.2.0') }}">
    <style>
        .form-error{
            color:red;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Welcome to the admin panel</p>
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf

                    @if ($errors->has('error_message'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error_message') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="email" data-validation="required" class="form-control" name="email" value="{{ old('email') }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" data-validation="required" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/form-validator/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    <script>
        $.validate({
            modules: 'date, security, file',
        });
    </script>
</body>

</html>
