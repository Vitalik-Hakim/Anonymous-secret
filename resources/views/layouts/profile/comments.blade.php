@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-md avatar-rounded" @if(!empty($user->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$user->avatar) }})" @endif>
                @if(empty($user->avatar))
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                @endif

                @if(Cache::has('user-is-online-' . $user->id))
                <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                @else
                <span class="badge bg-x" title="{{ __('main_card_offline') }}"></span>
                @endif
            </span>
        </div>
        <div class="col">
            <h2 class="page-title text-white">
                {{ $user->name }}
            </h2>
            
            <div class="page-subtitle">
                <div class="row">
                    <div class="col-auto text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20l10 -10m0 -5v5h5m-9 -1v5h5m-9 -1v5h5m-5 -5l4 -4l4 -4" /><path d="M19 10c.638 -.636 1 -1.515 1 -2.486a3.515 3.515 0 0 0 -3.517 -3.514c-.97 0 -1.847 .367 -2.483 1m-3 13l4 -4l4 -4" /></svg>
                        {{ __('main.profile_count_post', ['count' => $user->all_posts_user->count()]) }}
                    </div>
                
                    <div class="col-auto text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><line x1="12" y1="12" x2="12" y2="12.01" /><line x1="8" y1="12" x2="8" y2="12.01" /><line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                        <a href="{{ route('user_comments', ['username'=>$user->name])}}" class="text-light active">
                            {{ __(':count Comments', ['count' => $user->comments->count()]) }}
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">

    <div class="col-lg-8">
        @forelse($comments as $comment)
        <div class="card card-sm mb-3 shadow">
            <div class="card-header {{ $comment->item->gender->bg_color }}">
                <div class="col">
                    <a href="{{ route('show', ['id'=>$comment->item->id, 'slug'=>$comment->item->slug]) }}" class="text-white text-decoration-none">
                        <span class="small">
                            {{ $comment->item->gender->name }} - {{ __(':age Years Old', ['age' => $comment->item->age]) }}
                        </span>
                    </a>
                </div>
                
                <div class="col-auto">
                    <a href="{{ route('show', ['id'=>$comment->item->id, 'slug'=>$comment->item->slug]) }}" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="7 7 12 12 7 17" /><polyline points="13 7 18 12 13 17" /></svg>
                    </a>
                </div>
            </div>
                
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <span class="avatar avatar-rounded" @if(!empty($comment->user()->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$comment->user()->avatar) }})" @endif>
                            @if(empty($comment->user()->avatar))
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            @endif

                            @if(Cache::has('user-is-online-' . $comment->user_id))
                            <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                            @else
                            <span class="badge bg-x" title="{{ __('main_card_offline') }}"></span>
                            @endif
                        </span>
                    </div>
                    <div class="col">
                        <div class="text-truncate">
                            {{ $comment->comment_text }}
                        </div>
                        <div class="text-muted">
                            {{ Carbon::parse($comment->created_at)->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty">
            <div class="empty-img">
                <img src="{{ asset('resources/views/assets/img/comments.svg') }}" alt="">
            </div>
            <p class="empty-title">{{ __('main.no_user_comment') }}</p>
        </div>
        @endforelse
    </div>
    
    <div class="col-lg-4">
        <!-- Bottom ADV -->
        @if(!empty($setting_adv_bottom))
        @if($adv_bottom->status == 1)
        <div class="mb-3">
            {!! $adv_bottom->value !!}
        </div>
        @endif
        @endif
        <!-- End Bottom ADV -->
        
        <!-- Top Users -->
        @if($statusPoints == 1)
        @include('layouts.topUsers')
        @endif
        <!-- End Top Users -->
    </div>
    
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        {{ $comments->links() }}
    </div>
</div>

@endsection('content')