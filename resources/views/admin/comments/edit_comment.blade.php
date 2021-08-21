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
                    <a href="{{ url('admin/comments') }}">
                        {{ __('Comments') }}
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
            <form method="post" action="{{ route('update_edit_comment', $comment->id)}}">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('User') }}</label>
                        <div class="col">
                            <span class="avatar avatar-rounded" @if(!empty(App\Models\User::find($comment->user_id)->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.App\Models\User::find($comment->user_id)->avatar) }})" @endif>
                            @if(empty($user->avatar))
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                @endif

                                @if(Cache::has('user-is-online-' . $comment->user_id))
                                <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                                @else
                                <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                                @endif
                            </span>
                            {{ App\Models\User::find($comment->user_id)->name }}
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Comment') }}</label>
                        <div class="col">
                            <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" rows="4">{{ !empty(old('comment')) ? old('comment') : $comment->comment_text }}</textarea>
                            
                            @error('comment')
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
                                <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="2" {{ $comment->status == 2 ? 'selected' : '' }}>
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