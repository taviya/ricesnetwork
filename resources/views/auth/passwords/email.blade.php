@extends('user.layout.app')

@section('content')
<div class="front-page-container container-fluid mt-5">
    <h1 class="mb-3">{{ __('Confirm Password') }}</h1>
    <div class="mx-auto my-auto main-card p-5">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mb-3">
                <label>Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="primary-button mt-4 w-100 mb-4">
                <span class="btn__text">{{ __('Send Password Reset Link') }}</span>
            </button>
        </form>
    </div>
</div>
@endsection
