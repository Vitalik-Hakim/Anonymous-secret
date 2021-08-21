<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="{{ url('admin') }}" class="text-decoration-none text-white">
                <span class="text-green strong">Number </span>Pal
            </a>
        </h1>
        
        <div class="navbar-nav flex-row d-lg-none">
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
                    <a href="{{ url('saved') }}" class="dropdown-item">{{ __('main.nav_saved') }}</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('settings/edit') }}" class="dropdown-item">{{ __('main.nav_account') }}</a>
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
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                
                <li class="nav-item {{ (request()->is('admin')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Dashboard') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/users')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/users') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Users') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/posts')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/posts') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="6" rx="1" /><rect x="14" y="4" width="6" height="6" rx="1" /><rect x="4" y="14" width="6" height="6" rx="1" /><path d="M14 17h6" /><path d="M17 14v6" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Posts') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/genders')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/genders') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="7" cy="5" r="2" /><path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5" /><circle cx="17" cy="5" r="2" /><path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Genders') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/categories')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/categories') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Categories') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/comments')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/comments') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3" /><line x1="8" y1="9" x2="16" y2="9" /><line x1="8" y1="13" x2="14" y2="13" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Comments') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/pages')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/pages') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="3" width="14" height="18" rx="2" /><line x1="9" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="15" y2="11" /><line x1="9" y1="15" x2="13" y2="15" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Pages') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->is('admin/reports')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ url('admin/reports') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="5" x2="5" y2="21" /><line x1="19" y1="5" x2="19" y2="14" /><path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0" /><path d="M5 14a5 5 0 0 1 7 0a5 5 0 0 0 7 0" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Reports') }}
                        </span>
                    </a>
                </li>
                
                <li class="nav-item dropdown {{ (request()->is('admin/settings')) ? 'active': '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('Settings') }}
                        </span>
                    </a>
                    
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ (request()->is('admin/settings')) ? 'active': '' }}" href="{{ url('admin/settings') }}">
                                    {{ __('General') }}
                                </a>
                                
                                <a class="dropdown-item {{ (request()->is('admin/advertising')) ? 'active': '' }}" href="{{ url('admin/advertising') }}">
                                    {{ __('Advertising') }}
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    
                </li>
                
                <li class="nav-item dropdown {{ (request()->is('admin/points')) ? 'active': '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 5h12l3 5l-8.5 9.5a0.7 .7 0 0 1 -1 0l-8.5 -9.5l3 -5"></path><path d="M10 12l-2 -2.2l.6 -1"></path></svg>
                        </span>
                        <span class="nav-link-title">
                            {{ __('points.points_title') }}
                        </span>
                    </a>
                    
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ (request()->is('admin/points')) ? 'active': '' }}" href="{{ url('admin/points') }}">
                                    {{ __('points.points_title') }}
                                </a>
                                
                                <a class="dropdown-item {{ (request()->is('admin/badges')) ? 'active': '' }}" href="{{ url('admin/badges') }}">
                                    {{ __('Badges') }}
                                </a>
                                
                            </div>
                        </div>
                    </div>
                    
                </li>
                
                <li class="nav-item">
                    <a class="nav-link bg-yellow-lt" href="{{ url('/') }}" target="_blank">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 9h8v-3.586a1 1 0 0 1 1.707 -.707l6.586 6.586a1 1 0 0 1 0 1.414l-6.586 6.586a1 1 0 0 1 -1.707 -.707v-3.586h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1z" /></svg>
                        </span>
                        <span class="nav-link-title strong">
                            {{ __('Back to home') }}
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>

<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="navbar-nav flex-row order-md-last">
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
                    <a href="{{ url('saved') }}" class="dropdown-item">{{ __('main.nav_saved') }}</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('settings/edit') }}" class="dropdown-item">{{ __('main.nav_account') }}</a>
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
        </div>
    </div>
</header>