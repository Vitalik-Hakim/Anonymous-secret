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

<div class="row row-cards">
    
    <div class="table-responsive">
        <table class="table table-vcenter table-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Featured</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Likes</th>
                    <th>Views</th>
                    <th>Comments</th>
                    <th>Reports</th>
                    <th>Created</th>
                    <th class="w-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>
                        <span class="badge badge-pill {{ $post->gender->bg_color }}">
                            {{ $post->id }}
                        </span>
                    </td>
                    <td class="text-muted">
                        <span class="avatar avatar-xs avatar-rounded" @if(!empty(App\Models\User::find($post->user_id)->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.App\Models\User::find($post->user_id)->avatar) }})" @endif>
                        @if(empty(App\Models\User::find($post->user_id)->avatar))
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            @endif

                            @if(Cache::has('user-is-online-' . $post->user_id))
                            <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                            @else
                            <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                            @endif
                        </span>
                        {{ App\Models\User::find($post->user_id)->name }}
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0);" onclick="makeFeatured({{ $post->id }})" class="btn btn-sm @if($post->featured == 1) bg-lime-lt @else btn-light @endif" id="featured-post-{{ $post->id }}">
                            <span id="featured-post-{{ $post->id }}">@if($post->featured == 1){{ __('Yes') }}@else{{ __('No') }}@endif</span>
                        </a>
                    </td>
                    <td class="text-muted text-truncate small">
                        {{ Str::limit($post->title, 25) }} <a href="{{ route('show', ['id'=>$post->id,'slug'=>$post->slug]) }}" class="ms-1" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5"></path><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5"></path></svg>
                        </a>
                    </td>
                    <td class="strong small">
                        {{ $post->category->name }}
                    </td>
                    <td class="text-center">
                        <span class="badge badge-pill bg-azure-lt">
                            @json($post->likers()->count())
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-pill bg-azure-lt">
                            {{ $post->itemView() }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-pill bg-azure-lt">
                            {{ $post->comments()->count() }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-pill bg-yellow-lt">
                            {{ $post->reports()->count() }}
                        </span>
                    </td>
                    <td class="text-reset small">
                        {{ $post->created_at }}
                    </td>
                    <td>
                        <a href="javascript:void(0);" onclick="updateStatusPost({{ $post->id }})" class="btn btn-sm @if($post->status == 1) bg-lime-lt @else btn-danger @endif" id="status-post-{{ $post->id }}">
                            <span id="status-post-{{ $post->id }}">@if($post->status == 1){{ __('Active') }}@else{{ __('Disabled') }}@endif</span>
                        </a>
                        <a href="{{ route('edit_post', $post->id) }}" class="btn btn-sm">
                            {{ __('Edit') }}
                        </a>
                        <a href="{{ route('delete_post', $post->id) }}" onclick="return confirm('Do you confirm this operation?');" class="btn btn-sm btn-icon btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                        
                    </td>
                </tr>
                @empty
                <td>{{ __('There are no posts.') }}</td>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $posts->links() }}
    
    <div class="col-lg-12 mt-4">
        <div class="alert alert-info" role="alert">
            {{ __('Posts can be moderated by users with the "Moderator" role.')}}
        </div>
    </div>
    
</div>
@endsection('content')