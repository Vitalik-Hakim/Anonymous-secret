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
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">
                        {{ $page_name }}
                    </a>
                </li>
            </ol>
            
        </div>
    </div>
</div>

<div class="row row-cards row-deck">

    <form method="POST" action="{{ route('update_points') }}">
    @csrf
        
        <!-- config -->
        <div class="col-12">
            <div class="card shadow">

                <div class="card-header bg-dark">
                    <h2 class="card-title text-white">
                        {{ __('points.points_title') }}
                    </h2>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.status_points') }}</label>
                        <div class="col">
                            <select class="form-control" name="status_points">
                                <option value="1" {{ $settings::find('status_points')->value == 1 ? 'selected' : '' }}>
                                    {{ __('points.active') }}
                                </option>
                                <option value="0" {{ $settings::find('status_points')->value == 0 ? 'selected' : '' }}>
                                    {{ __('points.pause') }}
                                </option>
                            </select>
                            <small class="form-hint">
                                {{ __('points.status_points_suggestion') }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.status_points_for_new_entry') }}</label>
                        <div class="col">
                            <select class="form-control" name="status_points_new_entry">
                                <option value="1" {{ $settings::find('status_points_new_entry')->value == 1 ? 'selected' : '' }}>
                                    {{ __('points.active') }}
                                </option>
                                <option value="0" {{ $settings::find('status_points_new_entry')->value == 0 ? 'selected' : '' }}>
                                    {{ __('points.pause') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.status_points_for_like') }}</label>
                        <div class="col">
                            <select class="form-control" name="status_points_like">
                                <option value="1" {{ $settings::find('status_points_like')->value == 1 ? 'selected' : '' }}>
                                    {{ __('points.active') }}
                                </option>
                                <option value="0" {{ $settings::find('status_points_like')->value == 0 ? 'selected' : '' }}>
                                    {{ __('points.pause') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.status_points_for_comment') }}</label>
                        <div class="col">
                            <select class="form-control" name="status_points_comments">
                                <option value="1" {{ $settings::find('status_points_comments')->value == 1 ? 'selected' : '' }}>
                                    {{ __('points.active') }}
                                </option>
                                <option value="0" {{ $settings::find('status_points_comments')->value == 0 ? 'selected' : '' }}>
                                    {{ __('points.pause') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-text hr-text-left">{{ __('points.scores') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.points_for_new_entry') }}</label>
                        <div class="col">
                            <input type="number" class="form-control @error('points_new_entry') is-invalid @enderror" value="{{ !empty(old('points_new_entry')) ? old('points_new_entry') : $settings::find('points_new_entry')->value }}" name="points_new_entry">
                            @error('points_new_entry')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.points_for_like') }}</label>
                        <div class="col">
                            <input type="number" class="form-control @error('points_like') is-invalid @enderror" value="{{ !empty(old('points_like')) ? old('points_like') : $settings::find('points_like')->value }}" name="points_like">
                            @error('points_like')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.points_for_comment') }}</label>
                        <div class="col">
                            <input type="number" class="form-control @error('points_comments') is-invalid @enderror" value="{{ !empty(old('points_comments')) ? old('points_comments') : $settings::find('points_comments')->value }}" name="points_comments">

                            @error('points_comments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="hr-text hr-text-left">{{ __('points.final_badge') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('points.final_badge') }}</label>
                        <div class="col">
                            <select class="form-control" name="top_badge">
                                <option value="" {{ $settings::find('top_badge')->value == null ? 'selected' : '' }}>
                                    {{ __('No selection') }}
                                </option>
                                @foreach($badges as $badge)
                                <option value="{{ $badge->id }}" {{ $settings::find('top_badge')->value == $badge->id ? 'selected' : '' }}>
                                    {{ $badge->name }}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-hint">
                                {{ __('points.final_badge_suggestion') }}
                            </small>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('points.points_title') }}</button>
                </div>

            </div>
        </div>
        <!-- end config -->
        
    
    </form>
</div>
@endsection('content')