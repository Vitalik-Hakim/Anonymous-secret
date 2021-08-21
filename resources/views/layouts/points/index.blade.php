@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        
        @if($statusPoints == 0)
        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>
                </div>
                <div>
                    {{ __('points.points_status_alert') }}
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __("points.points_title") }}</h3>
            </div>
            <div class="card-body">
                <ul class="list list-timeline">
                    @foreach($points as $item)
                    <li>
                        <div class="list-timeline-icon bg-light">
                            @if($item->point_type == "new_entry")
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 14l2 2l4 -4" /></svg>
                            @elseif($item->point_type == "like")
                            <svg xmlns="http://www.w3.org/2000/svg" id="like-icon-3" class="icon icon-filled text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path></svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" /><line x1="10" y1="11" x2="14" y2="11" /><line x1="12" y1="9" x2="12" y2="13" /></svg>
                            @endif
                        </div>
                        <div class="list-timeline-content">
                            <div class="list-timeline-time">
                                {{ Carbon::parse($item->created_at)->diffForHumans() }}
                            </div>
                            <p class="list-timeline-title">+{{ $item->score }}</p>
                            <p class="text-muted">
                                @if($item->point_type == "new_entry")
                                {{ __('points.new_entry') }}
                                @elseif($item->point_type == "like")
                                {{ __('points.liked_it') }}
                                @else
                                {{ __('points.commented') }}
                                @endif
                                <a href="{{ route('show', ['id'=>$item->item_id, 'slug'=>$item->item->slug]) }}" class="strong">
                                    {{ $item->item->title }}
                                </a>
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                
                @if($points->isEmpty())
                <div class="empty">
                    <div class="empty-img">
                        <img src="{{ asset('resources/views/assets/img/points.svg') }}" alt="">
                    </div>
                    <p class="empty-title">
                        {{ __('points.you_have_no_points') }}
                    </p>
                </div>
                @endif
                
            </div>
        </div>
    </div>       
</div>

<div class="row">
    <div class="col-lg-12">
        {{ $points->links() }}
    </div>
</div>

@endsection('content')