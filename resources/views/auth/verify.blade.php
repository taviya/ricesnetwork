@extends('user.layout.app')

@section('content')

<div class="front-page-container container-fluid mt-5">
    <h1 class="mb-3">{{ __('Verify Your Email Address') }}</h1>
    <div class="mx-auto my-auto main-card p-5 text-center">
        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

        <div class="card-body ">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}<br />
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="default-btn btn btn-secondary">{{ __('click here to request another') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection