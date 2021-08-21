<div class="modal modal-blur fade" id="modal--write--story" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.write_a_story') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- if you are not logged in -->
            @if(!Auth::check())
            <div class="modal-body">
                <div class="empty">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="9" y1="10" x2="9.01" y2="10"></line><line x1="15" y1="10" x2="15.01" y2="10"></line><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0"></path></svg>
                    </div>
                    <p class="empty-title">
                        {{ __('main.notices_03') }}
                    </p>
                    <div class="empty-action">
                        <a href="{{ route('login') }}" class="btn">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ __('register') }}" class="btn btn-primary">
                            {{ __('Signup') }}
                        </a>
                    </div>
                </div>
            </div>
            <!-- if you have not set gender and birth -->
            @elseif(empty(Auth::user()->genders_id) | empty(Auth::user()->birth))
            <div class="empty">
                <div class="empty-img">
                    <img src="{{ asset('resources/views/assets/img/warning.svg') }}" alt="">
                </div>
                <p class="empty-title">{{ __('main.notices_01') }}</p>
                <p class="empty-subtitle text-muted">
                    {{ __('main.notices_02') }}
                </p>
                <div class="empty-action">
                    <a href="{{ url('settings/edit') }}" class="btn btn-red">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg> {{ __('main.notices_account') }}
                    </a>
                </div>
            </div>
            @else
            <!-- write story -->
            @if($status_write == 1)
                <form action="{{ url('write') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg @error('title', 'write') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="{{ __('main.title') }}">

                            @error('title', 'write')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <textarea class="form-control form-control-lg @error('story', 'write') is-invalid @enderror" name="story" rows="6" placeholder="{{ __('main.story') }}">{{ old('story') }}</textarea>

                            @error('story', 'write')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <div class="col">
                                <div class="form-selectgroup form-selectgroup-pills @error('category_id', 'write') is-invalid @enderror">
                                    @foreach($categories as $category)
                                    <label class="form-selectgroup-item">
                                        <input type="radio" id="category_id" name="category_id" value="{{ $category->id }}" class="form-selectgroup-input @error('category_id', 'write') is-invalid @enderror" {{ old('category_id') == $category->id ? 'checked' : '' }} @if(Auth::user()->total_point_count()<$category->score) disabled @endif>
                                        <span class="form-selectgroup-label" @if(Auth::user()->total_point_count()<$category->score) data-bs-toggle="tooltip" data-bs-html="true" title="{{ __('points.form_notice1') }}" @endif>
                                            {{ $category->name }}
                                        </span>
                                    </label>
                                    @endforeach
                                    
                                    @error('category_id', 'write')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('main.tags') }}</label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" placeholder="{{ __('main.separate_tag') }}" value="{{ old('tags') }}">
                        </div>

                    </div>
                    
                    <input type="hidden" name="genders_id" value="{{ Auth::user()->genders_id }}">
                    <input type="hidden" name="age" value="{{ Carbon::now()->diffInYears(Auth::user()->birth) }}">
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="9" y1="12" x2="15" y2="12"></line><line x1="12" y1="9" x2="12" y2="15"></line></svg> {{ __('main.btn_send') }}
                        </button>
                    </div>
                            
            </form>
            @else
            <!-- if new stories are paused -->
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{ asset('resources/views/assets/img/warning.svg') }}" alt="">
                </div>
                <div class="text-center">
                    <div class="empty-header">
                        {{ __('main.new_entries_paused') }}
                    </div>
                </div>
            </div>
            @endif
            <!-- end write story -->          
            @endif
        </div>
    </div>
</div>