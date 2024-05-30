<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Rices network" />
    <meta name="description" content="Rices network" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Rices network - Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/logo-icon.png') }}" />
    <link href="{{ asset('public/dist/css/style.min.css') }}" rel="stylesheet" />
    <style>
        .form-error {
            color: red;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div
            class="
          auth-wrapper
          d-flex
          no-block
          justify-content-center
          align-items-center
          bg-dark
        ">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center pt-3 pb-3">
                        <span class="db"><img src="{{ asset('public/assets/images/logo-icon.png') }}"
                                alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal mt-3" id="loginform" action="{{ route('admin.login') }}"
                        method="post">
                        @csrf

                        @if ($errors->has('error_message'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error_message') }}
                            </div>
                        @endif
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i
                                                class="mdi mdi-account fs-4"></i></span>
                                    </div>
                                    <input type="text" data-validation="required" name="email"
                                        value="{{ old('email') }}" class="form-control form-control-lg"
                                        placeholder="Email" aria-label="Email" aria-describedby="basic-addon1"
                                        required="" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i
                                                class="mdi mdi-lock fs-4"></i></span>
                                    </div>
                                    <input type="password" data-validation="required" name="password"
                                        class="form-control form-control-lg" placeholder="Password"
                                        aria-label="Password" aria-describedby="basic-addon1" required="" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3 text-center">
                                        <button class="btn btn-success text-white" type="submit">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(".preloader").fadeOut();
        $("#to-recover").on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $("#to-login").click(function() {
            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });

        $.validate({
            modules: 'date, security, file',
        });
    </script>
</body>

</html>
