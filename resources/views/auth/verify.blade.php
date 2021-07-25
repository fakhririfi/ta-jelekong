@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                {{-- @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif --}}
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Verify Your Email Address') }}</h1>
                                </div>

                                {{-- <p class="login-card-description">You must verify your email address, please check your email for a verification link.</p>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Resend Verification Link">
                                </form> --}}

                                @if (session('resent'))
                                    <div class="alert alert-success border-left-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.send') }}">{{ __('click here to request another') }}</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
