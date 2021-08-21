@extends('layouts.app')
@section('content')
<div class="page-header text-white d-print-none">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-rounded bg-blue-lt">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" /></svg>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                {{ $getCategory->name }}    
            </h2>
        </div>
    </div>
</div>
<!-- latest Items Section -->
<div class="row" data-masonry='{"percentPosition": true }'>

    @foreach($items as $item)

    @if(!empty($setting_adv_top))
    @if($adv_top->status == 1)
    @if($loop->first)
    <div class="col-3">
        <div class="card">
            <div class="card-body text-center">
                <p>{!! $adv_top->value !!}</p>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endif

    @if(!empty($setting_adv_bottom))
    @if($adv_bottom->status == 1)
    @if($loop->last)
    <div class="col-3">
        <div class="card">
            <div class="card-body text-center">
                <p>{!! $adv_bottom->value !!}</p>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endif

    @include('layouts.item')

    @endforeach
     
</div>

<div class="row">
    <div class="col-lg-12">
        <!-- if you don't have enough points to view -->
        @if($userPoints < $getCategory->score)
        @include('layouts.getMorePoints')
        <!-- if the list is empty -->
        @elseif ($items->isEmpty())
        @include('layouts.blank')
        <!-- end if the list is empty -->
        @endif
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        {{ $items->links() }}
    </div>
</div>

@endsection('content')