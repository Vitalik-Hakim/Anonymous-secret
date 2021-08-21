@extends('admin.layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                {{ $page_name }} ({{ $user->name }})
            </h2>
            
            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}">
                        {{ $site_name }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('admin/users') }}">
                        {{ __('Users') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">
                        {{ $page_name }}
                    </a>
                </li>
            </ol>
            
        </div>
    </div>
</div>

<div class="row row-cards">
    
    <div class="col-12">
        <div class="card">
            <form method="post" action="{{ route('update_edit_user', $user->id) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Avatar') }}</label>
                        <div class="col">
                            <span class="avatar avatar-lg rounded" @if(!empty($user->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$user->avatar) }})" @endif>
                                @if(empty($user->avatar))
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                @endif

                                @if(Cache::has('user-is-online-' . $user->id))
                                <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                                @else
                                <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Username') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ !empty(old('name')) ? old('name') : $user->name }}" name="name">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Email') }}</label>
                        <div class="col">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ !empty(old('email')) ? old('email') : $user->email }}" name="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Role') }}</label>
                        <div class="col">
                            <div class="form-selectgroup form-selectgroup-pills">
                                @foreach($roles as $role)
                                <label class="form-selectgroup-item">
                                    <input class="form-selectgroup-input" type="radio" name="role[]" value="{{ $role->name }}"
                                           {{ $user->roles->first()->id == $role->id ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label">{{ $role->name }}</span>
                                </label>
                                @endforeach
                            </div>
                            
                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="hr-text">{{ __('Change Password') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label for="password" class="form-label col-3 col-form-label">
                            {{ __('New Password') }}
                        </label>
                        <div class="col">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password" value="{{old('new_password')}}">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="new_confirm_password" class="form-label col-3 col-form-label">
                            {{ __('Confirm New Password') }}
                        </label>
                        <div class="col">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="new_confirm_password">
                        </div>
                    </div>

                

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection('content')