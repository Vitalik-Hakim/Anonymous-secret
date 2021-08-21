@extends('layouts.app')
@section('content')
<div class="page-header text-white d-print-none">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-rounded bg-yellow-lt">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4h6a2 2 0 0 1 2 2v14l-5 -3l-5 3v-14a2 2 0 0 1 2 -2" /></svg>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                {{ __('main.saved') }}    
            </h2>
        </div>
    </div>
</div>
<!-- latest Items Section -->
<div class="row" data-masonry='{"percentPosition": true }'>

    @foreach($items as $item)
    @include('layouts.item')
    @endforeach
    
    @if($items->isEmpty())
    @include('layouts.blank')
    @endif
    
</div>

<div class="row">
    <div class="col-lg-12">
        {{ $items->links() }}
    </div>
</div>

@endsection('content')