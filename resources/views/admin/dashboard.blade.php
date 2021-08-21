@extends('admin.layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                {{ $page_name }}
            </h2>
            
            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}">
                        {{ $site_name }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">
                        {{ $page_name }}
                    </a>
                </li>
            </ol>
            
        </div>
    </div>
</div>

<div class="row row-cards row-deck">
    
    <div class="col-sm-4">
        <div class="card shadow bg-success text-white">
            <div class="card-body p-4 text-center">
                <div class="h1 ">
                    {{ App\Models\ItemsViews::all()->count() }}
                </div>
                {{ __('Total Views') }}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card shadow bg-danger text-white">
            <div class="card-body p-4 text-center">
                <div class="h1">
                    {{ App\Models\Likes::all()->count() }}
                </div>
                {{ __('Total Likes') }}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card shadow bg-info text-white">
            <div class="card-body p-4 text-center">
                <div class="h1">
                    {{ \Conner\Tagging\Model\Tagged::all()->count() }}
                </div>
                {{ __('Total Tags') }}
            </div>
        </div>
    </div>
    
    
    <div class="col-md-8">
        <div class="card" style="height: calc(24rem + 10px)">
            <div class="card-header">
                <h2 class="card-title">
                    {{ __('Last Joined Users') }}
                </h2>
            </div>
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                <div class="divide-y-4">
                    @forelse($lastRegisteredUsers as $user)
                    <div>
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded" @if(!empty($user->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$user->avatar) }})" @endif>
                                    @if(empty($user->avatar))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                    @endif

                                    @if(Cache::has('user-is-online-' . $user->id))
                                    <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                                    @else
                                    <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                                    @endif
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>{{ $user->name }}</strong> just joined.
                                </div>
                                <div class="text-muted">
                                    {{ Carbon::parse($user->created_at)->diffForHumans() }} 
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    {{ __('Today no users have registered.') }}
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-blue text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="9" cy="7" r="4"></circle><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ App\Models\User::all()->count() }}
                                </div>
                                <div class="text-muted">
                                    {{ __('Total Users') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-purple text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="6" height="6" rx="1"></rect><rect x="14" y="4" width="6" height="6" rx="1"></rect><rect x="4" y="14" width="6" height="6" rx="1"></rect><path d="M14 17h6"></path><path d="M17 14v6"></path></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ App\Models\Items::all()->count() }}
                                </div>
                                <div class="text-muted">
                                    {{ __('Total Posts') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-pink text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="7" cy="5" r="2"></circle><path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5"></path><circle cx="17" cy="5" r="2"></circle><path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4"></path></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ App\Models\Genders::all()->count() }}
                                </div>
                                <div class="text-muted">
                                    {{ __('Total Genders') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-lime text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3"></path><line x1="8" y1="9" x2="16" y2="9"></line><line x1="8" y1="13" x2="14" y2="13"></line></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ App\Models\Comments::all()->count() }}
                                </div>
                                <div class="text-muted">
                                    {{ __('Total Comments') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-red text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="5" y1="5" x2="5" y2="21"></line><line x1="19" y1="5" x2="19" y2="14"></line><path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0"></path><path d="M5 14a5 5 0 0 1 7 0a5 5 0 0 0 7 0"></path></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ App\Models\Reports::all()->count() }}
                                </div>
                                <div class="text-muted">
                                    {{ __('Total Reports') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
    
@endsection('content')