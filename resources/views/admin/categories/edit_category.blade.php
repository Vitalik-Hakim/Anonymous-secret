@extends('admin.layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                {{ $page_name }} ({{ $category->name }})
            </h2>
            
            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}">
                        {{ $site_name }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('admin/categories') }}">
                        {{ __('Categories') }}
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
            <form method="post" action="{{ route('update_edit_category', $category->id) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ !empty(old('name')) ? old('name') : $category->name }}" name="name" placeholder="{{ __('Name...') }}">

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
                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ !empty(old('description')) ? old('description') : $category->description }}" name="description" placeholder="{{ __('Short description...') }}">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Score To Access') }}</label>
                        <div class="col">
                            <input type="number" class="form-control @error('score') is-invalid @enderror" value="{{ !empty(old('score')) ? old('score') : $category->score }}" name="score" placeholder="{{ __('0') }}">

                            @error('score')
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
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="2" {{ $category->status == 2 ? 'selected' : '' }}>
                                    {{ __('Disabled') }}
                                </option>
                            </select>
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