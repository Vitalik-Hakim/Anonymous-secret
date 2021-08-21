<header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            @if(!empty(App\Models\Settings::find('logo_image')->value))
            <img src="{{ asset('storage/app/public/images/logo/'.App\Models\Settings::find('logo_image')->value) }}" title="{{ $site_name }}" height="32px">
            @else
            {{ $site_name }}
            @endif
        </a>
          
        <div class="navbar-nav flex-row order-md-last">
            @if(Auth::check())
            <!-- Notifications -->
            <div class="nav-item dropdown d-md-flex me-3">
                <a href="javascript:void(0);" onclick="markAsRead()" class="nav-link px-0" data-bs-toggle="modal" data-bs-target="#notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    @if(Auth::user()->notification_count() >= 1)
                    <span class="badge badge-pill bg-red" id="notify">
                        {{ Auth::user()->notification_count() }}
                    </span>
                    @endif
                </a>
            </div>
            <!-- end Notifications -->
            
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                    @if(!empty(Auth::user()->avatar))
                    <span class="avatar avatar-sm" style="background-image: url({{ asset('storage/app/public/images/avatar/'.Auth::user()->avatar) }})"></span>
                    @else
                    <span class="avatar avatar-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                    </span>
                    @endif
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Str::limit(Auth::user()->name, 12) }}</div>
                        <div class="mt-1 small text-muted">{{ Str::limit(Auth::user()->email, 12) }}</div>
                    </div>
                </a>
              
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ url('profile/@'.Auth::user()->name) }}" class="dropdown-item">{{ __('main.nav_profile') }}</a>
                    <a href="{{ url('favorites') }}" class="dropdown-item">{{ __('main.nav_saved') }}</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('settings/edit') }}" class="dropdown-item">{{ __('main.nav_account') }}</a>
                    @hasrole('moderator')
                    <a href="{{ url('admin/posts') }}" class="dropdown-item">
                        {{ __('main.nav_post_moderation') }}
                    </a>
                    @endhasrole
                    @hasrole('admin')
                    <a href="{{ url('admin') }}" class="dropdown-item">
                        {{ __('main.nav_administration') }}
                    </a>
                    @endhasrole
                    <a href="{{ route('logout') }}" class="dropdown-item" 
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('main.nav_logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ url('login') }}">
                    <span class="nav-link-icon d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M20 12h-13l3 -3m0 6l-3 -3" /></svg>
                    </span>
                    <span class="nav-link-title d-none d-sm-block">
                        {{ __('main.nav_login') }}
                    </span>
                </a>
            </li>
            @endif  
        </div>
          
        <div class="navbar-collapse collapse" id="navbar-menu" style="">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link strong dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="3.6" y1="9" x2="20.4" y2="9" /><line x1="3.6" y1="15" x2="20.4" y2="15" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 0 18" /></svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('main.nav_explore') }}
                            </span>
                        </a>
                  
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">

                                    <a class="dropdown-item text-reset strong" href="#" data-bs-toggle="modal" data-bs-target="#modal--write--story">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="12" x2="15" y2="12" /><line x1="12" y1="9" x2="12" y2="15" /></svg> 
                                        {{ __('main.nav_submit_a_story') }}
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    
                                    <!-- Categories -->
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                            {{ __('main.nav_categories') }}
                                        </a>
                                        <div class="dropdown-menu">
                                            @forelse($categories as $category)
                                            <a class="dropdown-item" href="{{ route('navCategories', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                            @empty
                                            <span class="dropdown-item">
                                                {{ __('main.there_are_no_categories') }}
                                            </span>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- end Categories -->
                                    
                                    <!-- Pages -->
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                            {{ __('main.nav_pages') }}
                                        </a>
                                        <div class="dropdown-menu">
                                            @forelse($pages as $page)
                                            <a href="{{ url('page/'.$page->slug) }}" class="dropdown-item text-truncate">
                                                {{ $page->title }}
                                            </a>
                                            @empty
                                            <span class="dropdown-item">
                                                {{ __('main.there_are_no_pages') }}
                                            </span>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- end Pages -->
                                    
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
              
                <div class="ms-md-auto ps-md-2 py-2 py-md-0 me-md-2 order-first order-md-last flex-grow-1">
                    <form action="{{ route('search') }}" method="get">
                        @csrf
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                            </span>
                            <input type="text" class="form-control form-control-rounded form-control-dark @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" type="search" placeholder="{{ __('main.nav_search') }}" aria-label="Search in website">
                            
                            @error('key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="navbar-expand-md sticky-top shadow">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-dark">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ (request()->is('/')) ? 'active': '' }}">
                        <a class="nav-link strong" href="{{ url('/') }}">
                            <span class="nav-link-icon d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="6" x2="13" y2="6" /><line x1="4" y1="12" x2="11" y2="12" /><line x1="4" y1="18" x2="11" y2="18" /><polyline points="15 15 18 18 21 15" /><line x1="18" y1="6" x2="18" y2="18" /></svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('main.nav_latests') }}
                            </span>
                        </a>
                    </li>
                    
                    <li class="nav-item {{ (request()->is('viral')) ? 'active': '' }}">
                        <a class="nav-link strong" href="{{ url('viral') }}">
                            <span class="nav-link-icon d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="12" x2="6" y2="12" /><line x1="12" y1="3" x2="12" y2="6" /><line x1="7.8" y1="7.8" x2="5.6" y2="5.6" /><line x1="16.2" y1="7.8" x2="18.4" y2="5.6" /><line x1="7.8" y1="16.2" x2="5.6" y2="18.4" /><path d="M12 12l9 3l-4 2l-2 4l-3 -9" /></svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('main.nav_viral') }}
                            </span>
                        </a>
                    </li>
                    
                    <li class="nav-item {{ (request()->is('random')) ? 'active': '' }}">
                        <a class="nav-link strong" href="{{ url('random') }}">
                            <span class="nav-link-icon d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17h5l1.67 -2.386m3.66 -5.227l1.67 -2.387h6" /><path d="M18 4l3 3l-3 3" /><path d="M3 7h5l7 10h6" /><path d="M18 20l3 -3l-3 -3" /></svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('main.nav_random') }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
                  
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <a href="#" class="btn btn-white btn-pill strong" data-bs-toggle="modal" data-bs-target="#modal--write--story">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="12" x2="15" y2="12" /><line x1="12" y1="9" x2="12" y2="15" /></svg> {{ __('main.btn_submit_a_story') }}
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>

@if(Auth::check())
<!-- show notifications only if user is logged in -->
@include('layouts.notifications')
@endif

<!-- form in modal write a story -->
@include('layouts.modal.form_write_story')