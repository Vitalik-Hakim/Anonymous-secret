@extends('layouts.app')
@section('content')
<div class="page-header text-white d-print-none">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-rounded bg-blue-lt">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="9" x2="19" y2="9" /><line x1="5" y1="15" x2="19" y2="15" /><line x1="11" y1="4" x2="7" y2="20" /><line x1="17" y1="4" x2="13" y2="20" /></svg>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                {{ $tag }}    
            </h2>
        </div>
    </div>
</div>

<div class="row" data-masonry='{"percentPosition": true }'>

    @foreach($items as $item)

    <!-- ads top -->
    @if(!empty($setting_adv_top))
    @if($adv_top->status == 1)
    @if($loop->first)
    <div class="col-lg-3">
        <div class="mb-3">
            {!! $adv_top->value !!}
        </div>
    </div>
    @endif
    @endif
    @endif
    <!-- end ads -->
    
    <!-- ads bottom -->
    @if(!empty($setting_adv_bottom))
    @if($adv_bottom->status == 1)
    @if($loop->last)
    <div class="col-lg-3">
        <div class="mb-3">
            {!! $adv_bottom->value !!}
        </div>
    </div>
    @endif
    @endif
    @endif
    <!-- end ads -->

    <!-- items -->
    @include('layouts.item')
    <!-- end items -->
    
    @endforeach

    <!-- if the list is empty -->
    @if($items->isEmpty())
    @include('layouts.blank')
    @endif
    <!-- end if the list is empty -->
    
</div>

<div class="row">
    <div class="col-lg-12">
        {{ $items->links() }}
    </div>
</div>

@endsection('content')