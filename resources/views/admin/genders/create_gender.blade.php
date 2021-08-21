@extends('admin.layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                {{ $page_name }}
            </h2>
            
            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}">
                        {{ $site_name }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('admin/genders') }}">
                        {{ __('Genders') }}
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
            <form method="post" action="{{ route('store_new_gender') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="{{ __('Name...') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Description') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" name="description" placeholder="{{ __('Short description...') }}">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Color') }}</label>
                        <div class="col">
                            
                            <div class="row g-2">
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-dark" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-dark rounded-circle"></span>
                                    </label>
                                </div>
                                
                                <div class="col-auto">
                                    <label class="form-colorinput form-colorinput-light">
                                        <input name="bg_color" type="radio" value="bg-white" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-white rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-blue" class="form-colorinput-input" name="bg_color">
                                        <span class="form-colorinput-color bg-blue rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-azure" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-azure rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-indigo" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-indigo rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-purple" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-purple rounded-circle"></span>
                                    </label>
                                </div>
                                
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-pink" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-pink rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-red" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-red rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-orange" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-orange rounded-circle"></span>
                                    </label>
                                </div>

                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-yellow" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-yellow rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-lime" class="form-colorinput-input">
                                        <span class="form-colorinput-color bg-lime rounded-circle"></span>
                                    </label>
                                </div>
                            </div>

                            @error('bg_color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection('content')