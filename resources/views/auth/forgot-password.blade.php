@extends('layouts.guest')
@section('content')
<div class="container-tight py-6">
    
    <div class="text-center mt-4 mb-4">
        <a href="{{ url('/') }}" class="navbar-brand d-none-navbar-horizontal pr-0 pr-md-3">
            {{ $site_name }}
        </a>
    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">{{ __('Forgot Password') }}</h3>
        </div>
        
        <div class="card-body">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Email Password Reset Link') }}</button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection