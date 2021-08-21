@extends('admin.layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                {{ $page_name }} ({{ $post->title }})
            </h2>
            
            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}">
                        {{ $site_name }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('admin/posts') }}">
                        {{ __('Posts') }}
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
    
    <div class="col-8">
        <div class="card">
            <form method="post" action="{{ route('update_edit_post', $post->id) }}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Title') }}</label>
                        <div class="col">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ !empty(old('title')) ? old('title') : $post->title }}" name="title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Story') }}</label>
                        <div class="col">
                            <textarea class="form-control @error('story') is-invalid @enderror" name="story" rows="4">{{ !empty(old('story')) ? old('story') : $post->story }}</textarea>
                            
                            @error('story')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Gender') }}</label>
                        <div class="col">
                            <select class="form-control" name="genders_id">
                                @foreach($genders as $gender)
                                <option value="{{ $gender->id }}" {{ $post->genders_id == $gender->id ? 'selected' : '' }}>
                                    {{ $gender->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('URL') }}</label>
                        <div class="col">
                            <input type="text" class="form-control" value="{{ $post->slug }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Categories') }}</label>
                        <div class="col">
                            <div class="form-selectgroup form-selectgroup-pills">
                                @foreach($categories as $cat)
                                <label class="form-selectgroup-item">
                                    <input class="form-selectgroup-input" type="radio" name="category" value="{{ $cat->id }}"
                                           {{ $post->category()->first()->id == $cat->id ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label">{{ $cat->name }}</span>
                                </label>
                                @endforeach
                            </div>
                            
                            @error('categories')
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
    
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                @forelse($post->tags as $tag)
                <a href="{{ route('delete_tag', ['id'=>$post->id, 'tag'=>$tag->name]) }}" onclick="return confirm('Do you confirm this operation?');" class="badge bg-azure-lt">
                    {{ $tag->slug }} <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                </a>
                @empty
                {{ __('There are no tags.') }}
                @endforelse
            </div>
        </div>
        
        <div class="card mt-2" style="height: calc(24rem + 10px)">
            <div class="card-header">
                <h2 class="card-title">
                    {{ __('People who love this post') }}
                </h2>
            </div>
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                <div class="divide-y-4">
                    @forelse($post->likers as $user)
                    <div>
                        <div class="row">
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>{{ $user->name }}</strong>
                                </div>
                                <div class="text-muted">{{ $post->created_at }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    {{ __('Nobody likes it yet.') }}
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>
    
</div>
@endsection('content')