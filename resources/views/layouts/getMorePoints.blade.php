<div class="row">
    <div class="empty">
        <div class="empty-img">
            <img src="{{ asset('resources/views/assets/img/block.svg') }}" alt="">
        </div>
        <div class="empty-header">
            {{ __('points.access_is_not_allowed') }}
        </div>
        <p class="empty-title">
            {{ __('points.points_needed_to_enter', ['score'=>$getCategory->score]) }}
        </p>
    </div>
</div>