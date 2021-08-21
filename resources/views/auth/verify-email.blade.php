@extends('layouts.guest')
@section('content')
<div class="container-tight py-6">
    
    <div class="text-center mt-4 mb-4">
        <a href="{{ url('/') }}" class="navbar-brand d-none-navbar-horizontal pr-0 pr-md-3">
            {{ $site_name }}
        </a>
    </div>

    <div class="card card-md shadow">

        <div class="card-header">
            <h3 class="card-title">{{ __('Reset Password') }}</h3>
        </div>
        
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            
            <div class="card-body">
                <button class="btn btn-primary" type="submit">{{ __('Resend Verification Email') }}</button>
            </div>
        </form>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Logout') }}
                </button>

            </form>
        
    </div>
    
</div>
@endsection