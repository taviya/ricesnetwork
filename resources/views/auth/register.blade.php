@extends('user.layout.app')

@section('content')
<div class="front-page-container container-fluid mt-5">
    <h1 class="mb-3">{{ __('Register') }}</h1>
    <div class="mx-auto my-auto main-card p-5">
        <form method="POST" action="{{ route('register') }}">
            @csrf <!-- Add CSRF token -->
            <div class="mb-3">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">{{ __('I accept the Terms of Use and the Privacy Policy.') }}</label>
            </div>

            <button type="submit" class="primary-button mt-4 w-100 mb-4">
                <span class="btn__text">{{ __('Sign Up') }}</span>
            </button>
        </form>
        <p>
            {{ __('By signing up, you agree to our') }} <a href="#sec">{{ __('Terms of Use') }}</a> {{ __('and') }} <a href="#sec">{{ __('Privacy Policy') }}</a>.
        </p>
    </div>
</div>
@endsection
