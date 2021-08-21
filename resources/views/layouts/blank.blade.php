<div class="row">
    <div class="empty">
        <div class="empty-img">
            <img src="{{ asset('resources/views/assets/img/no_results.svg') }}" alt="">
        </div>
        <div class="empty-header">
            {{ __('main.there_are_no_results') }}
        </div>
        <div class="empty-action">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal--write--story" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="9" y1="12" x2="15" y2="12"></line><line x1="12" y1="9" x2="12" y2="15"></line></svg>
                {{ __('main.btn_submit_a_story') }}
            </a>
        </div>
        
    </div>
</div>