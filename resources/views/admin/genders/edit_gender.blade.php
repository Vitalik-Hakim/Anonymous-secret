@extends('admin.layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                {{ $page_name }} ({{ $gender->name }})
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
            <form method="post" action="{{ route('update_edit_gender', $gender->id) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ !empty(old('name')) ? old('name') : $gender->name }}" name="name" placeholder="{{ __('Name...') }}">

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
                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ !empty(old('description')) ? old('description') : $gender->description }}" name="description" placeholder="{{ __('Short description...') }}">

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
                                        <input name="bg_color" type="radio" value="bg-dark" class="form-colorinput-input" {{ $gender->bg_color == "bg-dark" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-dark rounded-circle"></span>
                                    </label>
                                </div>
                                
                                <div class="col-auto">
                                    <label class="form-colorinput form-colorinput-light">
                                        <input name="bg_color" type="radio" value="bg-white" class="form-colorinput-input" {{ $gender->bg_color == "bg-white" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-white rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-blue" class="form-colorinput-input" {{ $gender->bg_color == "bg-blue" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-blue rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-azure" class="form-colorinput-input" {{ $gender->bg_color == "bg-azure" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-azure rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-indigo" class="form-colorinput-input" {{ $gender->bg_color == "bg-indigo" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-indigo rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-purple" class="form-colorinput-input" {{ $gender->bg_color == "bg-purple" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-purple rounded-circle"></span>
                                    </label>
                                </div>
                                
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-pink" class="form-colorinput-input" {{ $gender->bg_color == "bg-pink" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-pink rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-red" class="form-colorinput-input" {{ $gender->bg_color == "bg-red" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-red rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-orange" class="form-colorinput-input" {{ $gender->bg_color == "bg-orange" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-orange rounded-circle"></span>
                                    </label>
                                </div>

                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-yellow" class="form-colorinput-input" {{ $gender->bg_color == "bg-yellow" ? 'checked' : '' }}>
                                        <span class="form-colorinput-color bg-yellow rounded-circle"></span>
                                    </label>
                                </div>
                            
                                <div class="col-auto">
                                    <label class="form-colorinput">
                                        <input name="bg_color" type="radio" value="bg-lime" class="form-colorinput-input" {{ $gender->bg_color == "bg-lime" ? 'checked' : '' }}>
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
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection('content')