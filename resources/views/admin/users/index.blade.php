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
    
    <div class="table-responsive">
        <table class="table table-vcenter table-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Points</th>
                    <th>Roles</th>
                    <th>Registered</th>
                    <th class="w-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class="text-muted">
                        <span class="avatar avatar-xs avatar-rounded" @if(!empty($user->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$user->avatar) }})" @endif>
                        @if(empty($user->avatar))
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            @endif

                            @if(Cache::has('user-is-online-' . $user->id))
                            <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                            @else
                            <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                            @endif
                        </span>
                        {{ $user->name }}
                    </td>
                    <td class="text-muted">{{ $user->email }}</td>
                    <td class="text-muted">
                        <span class="badge @if(!empty($user->gender->bg_color)){{$user->gender->bg_color}}@endif">
                            @if(!empty($user->gender->name)){{ $user->gender->name }}@else{{__('Not set')}}@endif
                        </span>
                    </td>
                    
                    <td>
                        <span class="badge badge-pill bg-red-lt">
                            {{ $user->total_point_count() }}
                        </span>
                    </td>
                    
                    <td>
                        @foreach($user->roles as $role)
                        <span class="badge bg-secondary-lt">
                            {{ $role->name }}
                        </span>
                        @endforeach
                    </td>
                    <td class="text-reset">{{ $user->created_at }}</td>
                    <td>
                        
                        <a href="{{ route('edit_user', $user->id) }}" class="btn btn-sm">
                            {{ __('Edit') }}
                        </a>
                        <a href="{{ route('delete_user', $user->id) }}" onclick="return confirm('Do you confirm this operation?');" class="btn btn-sm btn-icon btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                        
                    </td>
                </tr>
                @empty
                {{ __('There are no users.') }}
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $users->links() }}
    
</div>
@endsection('content')