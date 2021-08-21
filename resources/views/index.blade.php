@extends('layouts.app')
@section('content')
<!-- latest Items Section -->
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