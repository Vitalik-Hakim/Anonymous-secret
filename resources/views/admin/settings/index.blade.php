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

    <form method="POST" action="{{ route('update_settings') }}" enctype="multipart/form-data">
    @csrf
        <!-- seo title e meta tag -->
        <div class="col-12">
            
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            
            <div class="card shadow mb-4">

                <div class="card-header bg-dark">
                    <h2 class="card-title text-white">
                        {{ __('Logo & Favicon') }}
                    </h2>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Logo</label>
                        <div class="col">
                            
                            @if(!empty($settings::find('logo_image')->value))
                            <div class="mb-2">
                                <img src="{{ asset('storage/app/public/images/logo/'.App\Models\Settings::find('logo_image')->value) }}" class="rounded" title="{{ $site_name }}">

                                <a href="{{ route('delete_logo') }}" class="btn btn-link btn-icon text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </a>
                                
                            </div>
                            @endif
                            
                            <input type="file" name="logo_image" class="form-control form-control-lg @error('logo_image') is-invalid @enderror">

                            @error('logo_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Favicon</label>
                        <div class="col">
                            
                            @if(!empty($settings::find('favicon')->value))
                            <div class="mb-2">
                                <img src="{{ asset('storage/app/public/images/logo/favicon/'.App\Models\Settings::find('favicon')->value) }}" class="rounded" title="{{ $site_name }}">

                                <a href="{{ route('delete_favicon') }}" class="btn btn-link btn-icon text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </a>
                                
                            </div>
                            @endif
                            
                            <input type="file" name="favicon" class="form-control form-control-lg @error('favicon') is-invalid @enderror">

                            @error('favicon')
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

            </div>
            
            
            
            <div class="card shadow">

                <div class="card-header bg-dark">
                    <h2 class="card-title text-white">
                        {{ __('Title & Meta Tag') }}
                    </h2>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Title</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-lg @error('site_name') is-invalid @enderror" value="{{ !empty(old('site_name')) ? old('site_name') : $settings::find('site_name')->value }}" name="site_name">

                            @error('site_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Tagline</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-lg @error('site_tagline') is-invalid @enderror" value="{{ !empty(old('site_tagline')) ? old('site_tagline') : $settings::find('site_tagline')->value }}" name="site_tagline">
                            <small class="form-hint">
                                {{ __('Simple words, like a motto on your website.') }}
                            </small>

                            @error('site_tagline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Description</label>
                        <div class="col">
                            <textarea class="form-control form-control-lg @error('site_description') is-invalid @enderror" data-bs-toggle="autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;" name="site_description">{{ !empty(old('site_description')) ? old('site_description') : $settings::find('site_description')->value }}</textarea>
                            <small class="form-hint">
                                {{ __('A brief but accurate description. We recommend a maximum of 155 characters.') }}
                            </small>

                            @error('site_description')
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

            </div>
        </div>
        <!-- end seo title e meta tag -->

        <!-- config -->
        <div class="col-12 mt-4">
            <div class="card shadow">

                <div class="card-header bg-dark">
                    <h2 class="card-title text-white">
                        {{ __('Configuration') }}
                    </h2>
                </div>
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Pause New Posts') }}</label>
                        <div class="col">
                            <select class="form-control" name="active_upload">
                                <option value="1" {{ $settings::find('active_upload')->value == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="0" {{ $settings::find('active_upload')->value == 0 ? 'selected' : '' }}>
                                    {{ __('Pause') }}
                                </option>
                            </select>
                            <small class="form-hint">
                                {{ __('Pause new entries, a warning will be shown.') }}
                            </small>
                        </div>
                    </div>

                    <div class="hr-text hr-text-left">{{ __('Posts') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Results Per Page</label>
                        <div class="col">
                            <input type="number" class="form-control @error('results_per_page') is-invalid @enderror" value="{{ !empty(old('results_per_page')) ? old('results_per_page') : $settings::find('results_per_page')->value }}" name="results_per_page">
                            <small class="form-hint">
                                {{ __('How many results per page you want to show.') }}
                            </small>

                            @error('results_per_page')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Minimum Characters</label>
                        <div class="col">
                            <input type="number" class="form-control @error('minimum_characters') is-invalid @enderror" value="{{ !empty(old('minimum_characters')) ? old('minimum_characters') : $settings::find('minimum_characters')->value }}" name="minimum_characters">
                            <small class="form-hint">
                                {{ __('How many minimum characters are available for each story.') }}
                            </small>

                            @error('minimum_characters')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Maximum Characters</label>
                        <div class="col">
                            <input type="number" class="form-control @error('maximum_characters') is-invalid @enderror" value="{{ !empty(old('maximum_characters')) ? old('maximum_characters') : $settings::find('maximum_characters')->value }}" name="maximum_characters">
                            <small class="form-hint">
                                {{ __('How many maximum characters are available for each story.') }}
                            </small>

                            @error('maximum_characters')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Maximum Preview Chars</label>
                        <div class="col">
                            <input type="number" class="form-control @error('story_preview_chars') is-invalid @enderror" value="{{ !empty(old('story_preview_chars')) ? old('story_preview_chars') : $settings::find('story_preview_chars')->value }}" name="story_preview_chars">
                            <small class="form-hint">
                                {{ __('How many characters to show for the preview of each story.') }}
                            </small>

                            @error('story_preview_chars')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">New Entries</label>
                        <div class="col">
                            <select class="form-control" name="new_entries">
                                <option value="1" {{ $settings::find('new_entries')->value == 1 ? 'selected' : '' }}>
                                    {{ __('Immediately visible') }}
                                </option>
                                <option value="2" {{ $settings::find('new_entries')->value == 2 ? 'selected' : '' }}>
                                    {{ __('In moderation') }}
                                </option>
                            </select>
                            <small class="form-hint">
                                {{ __('Set whether new entries will be already visible by default or in moderation.') }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Words Censored') }}</label>
                        <div class="col">
                            <select class="form-control" name="words_censored">
                                <option value="0" {{ $settings::find('words_censored')->value == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}
                                </option>
                                <option value="1" {{ $settings::find('words_censored')->value == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                            </select>
                            <small class="form-hint">
                                {{ __("Enable or Disable Word Censorship. You can add or edit new words by opening and editing the file within the path: vendor\snipe\banbuilder\src\dict\dictionary.php") }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="hr-text hr-text-left">{{ __('Comments') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Minimum Characters</label>
                        <div class="col">
                            <input type="number" class="form-control @error('min_characters_comment') is-invalid @enderror" value="{{ !empty(old('min_characters_comment')) ? old('min_characters_comment') : $settings::find('min_characters_comment')->value }}" name="min_characters_comment">
                            <small class="form-hint">
                                {{ __('How many minimum characters are available for each comment.') }}
                            </small>

                            @error('min_characters_comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Maximum Characters</label>
                        <div class="col">
                            <input type="number" class="form-control @error('max_characters_comment') is-invalid @enderror" value="{{ !empty(old('max_characters_comment')) ? old('max_characters_comment') : $settings::find('max_characters_comment')->value }}" name="max_characters_comment">
                            <small class="form-hint">
                                {{ __('How many maximum characters are available for each comment.') }}
                            </small>

                            @error('max_characters_comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="hr-text hr-text-left">{{ __('Widgets') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Random Items</label>
                        <div class="col">
                            <input type="number" class="form-control @error('random_items') is-invalid @enderror" value="{{ !empty(old('random_items')) ? old('random_items') : $settings::find('random_items')->value }}" name="random_items">
                            <small class="form-hint">
                                {{ __('How many items to show in the "Random Items" widget.') }}
                            </small>

                            @error('random_items')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Random Users</label>
                        <div class="col">
                            <input type="number" class="form-control @error('random_users') is-invalid @enderror" value="{{ !empty(old('random_users')) ? old('random_users') : $settings::find('random_users')->value }}" name="random_users">
                            <small class="form-hint">
                                {{ __('How many users to show in the "Random Users" widget.') }}
                            </small>

                            @error('random_users')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    
                    <div class="hr-text hr-text-left">{{ __('Reports') }}</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Alert Reports</label>
                        <div class="col">
                            <input type="number" class="form-control @error('alert_reports') is-invalid @enderror" value="{{ !empty(old('alert_reports')) ? old('alert_reports') : $settings::find('alert_reports')->value }}" name="alert_reports">
                            <small class="form-hint">
                                {{ __('How many reports must a post receive to be subjected to examination. A post after receiving "X" reports will be shown in the "Reports" section.') }}
                            </small>

                            @error('alert_reports')
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

            </div>
        </div>
        <!-- end config -->
        
        <div class="card shadow mt-4">

            <div class="card-header bg-dark">
                <h2 class="card-title text-white">
                    {{ __('Advertising') }}
                </h2>
            </div>
            <div class="card-body">

                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Top</label>
                    <div class="col">
                        <select class="form-control" name="adv_top">
                        @foreach($advertising as $adv)
                            <option value="{{ $adv->id }}" {{ $adv->id == $settings::find('adv_top')->value ? 'selected' : '' }}>
                                {{ $adv->name }}
                            </option>
                        @endforeach
                            <option value="" {{ $settings::find('adv_top')->value == null ? 'selected' : '' }}>
                                {{ __('No advertising') }}
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Bottom</label>
                    <div class="col">
                        <select class="form-control" name="adv_bottom">
                        @foreach($advertising as $adv)
                            <option value="{{ $adv->id }}" {{ $adv->id == $settings::find('adv_bottom')->value ? 'selected' : '' }}>
                                {{ $adv->name }}
                            </option>
                        @endforeach
                            <option value="" {{ $settings::find('adv_bottom')->value == null ? 'selected' : '' }}>
                                {{ __('No advertising') }}
                            </option>
                        </select>
                    </div>
                </div>


            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </div>
    
    </form>
</div>
@endsection('content')