@extends('user.layout.app')

@section('content')
<div class="front-page-container container-fluid mt-5">
    <h1 class="mb-3">{{ __('Login') }}</h1>
    <div class="mx-auto my-auto main-card p-5">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                @error('error_message')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="primary-button mt-4 w-100 mb-4">
                <span class="btn__text">Sign In</span>
            </button>

            <div class="seperator"><b>OR</b></div>
            <div class="d-grid text-center">
                <div class="dt_social_login dt_social_login_btn">
                    <button id="connectButton" type="button" class="btn text-white text-center btn-lg fw-bold mb-2 btn-main w-100">
                        <img src="{{asset('public/assets/upload/metamask.png')}}" class="w-10" height="35px" width="35px">

                        <span class="w-5/6">Login With Metamask</span>
                    </button>
                </div>
            </div>

            <div class="links">
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
                <a href="{{ route('register') }}">Do not have an account?</a>
            </div>
        </form>
    </div>
</div>
@endsection



<script>
    function sendLoginRequest(ethAddress, message1, signature, type = 1) {
        $.ajax({
            url: "{{ route('authenticate') }}",
            type: 'POST',
            async: false,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            data: {
                'ethAddress': ethAddress,
                'message': message1,
                'signature': signature,
            },
            success: (xhr, data) => {
                window.location = "{{ route('home') }}";
            },
            error: (xhr, data) => {
                message(xhr.responseJSON.message, 'danger');
            }
        });
    }
</script>