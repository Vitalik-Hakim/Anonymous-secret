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
            <h3 class="card-title">{{ __('Login') }}</h3>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
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
                <div class="mb-2">
                    <label class="form-label">
                        {{ __('Password') }}
                        @if (Route::has('password.request'))
                        <span class="form-label-description">
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </span>
                        @endif
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password">
                    </div>
                </div>
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="form-check-label">{{ __('Remember Me') }}</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="text-center text-muted mt-4">
        Don't have an account yet? <a href="{{ url('register') }}" tabindex="-1">Register</a>
    </div>
    
</div>
@endsection