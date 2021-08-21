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
                    <a href="{{ url('admin/pages') }}">
                        {{ __('Pages') }}
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
            <form method="post" action="{{ route('store_new_page') }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Title</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="{{ __('Title...') }}" name="title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">
                            Body
                        </label>
                        <div class="col">
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="15">{{ old('body') }}</textarea>
                            
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Status') }}</label>
                        <div class="col">
                            <select class="form-control" name="status">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>
                                    {{ __('Disabled') }}
                                </option>
                            </select>
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