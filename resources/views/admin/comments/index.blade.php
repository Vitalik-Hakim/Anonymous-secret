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
                    <th>User</th>
                    <th>Comment</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="w-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td class="text-muted">
                        <span class="avatar avatar-xs avatar-rounded" @if(!empty(App\Models\User::find($comment->user_id)->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.App\Models\User::find($comment->user_id)->avatar) }})" @endif>
                        @if(empty($user->avatar))
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            @endif

                            @if(Cache::has('user-is-online-' . $comment->user_id))
                            <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                            @else
                            <span class="badge bg-x" title="{{ __('main.card_offline') }}"></span>
                            @endif
                        </span>
                        {{ App\Models\User::find($comment->user_id)->name }}
                    </td>
                    <td class="text-muted strong">{{ Str::limit($comment->comment_text, 25) }}</td>
                    <td class="strong">
                        <a href="{{ route('edit_post', $comment->item_id) }}" target="_blank">
                            {{ App\Models\Items::find($comment->item_id)->title }}
                        </a>
                    </td>
                    <td>
                        @if($comment->status == 1)
                        <span class="badge bg-lime-lt">{{ __('Active') }}</span>
                        @else
                        <span class="badge bg-red-lt">{{ __('Disabled') }}</span>
                        @endif
                    </td>
                    <td class="text-reset">{{ $comment->created_at }}</td>
                    <td>
                        <a href="{{ route('edit_comment', $comment->id) }}" class="btn btn-sm">
                            {{ __('Edit') }}
                        </a>
                        <a href="{{ route('delete_comment', $comment->id) }}" onclick="return confirm('Do you confirm this operation?');" class="btn btn-sm btn-icon btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <td>{{ __('There are no comments.') }}</td>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $comments->links() }}
    
</div>
@endsection('content')