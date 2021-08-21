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
            <h3 class="card-title">{{ __('Confirm Password') }}</h3>
        </div>
        
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        
        <form method="POST" action="{{ route('password.confirm') }}">
            {{ csrf_field() }}
            <div class="card-body">
                
                <div class="mb-2">
                    <label class="form-label">
                        {{ __('Password') }}
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

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Confirm') }}</button>
                </div>
            </div>
        </form>
    </div>
    
</div>
@endsection