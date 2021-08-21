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
    
    <div class="col-lg-12">
        <div class="alert alert-danger" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
                <div>
                    <h4 class="alert-title">{{ __('Post with many reports.') }}</h4>
                    <div class="text-muted small">{{ __('Only posts that have reached a significant number of reports will be shown in the list. It facilitates the examination and eventual removal of the offending post.') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-vcenter table-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Reports Count</th>
                    <th>Created</th>
                    <th class="w-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                
                @if($report->reports()->count() >= App\Models\Settings::find('alert_reports')->value)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td class="strong">
                        <a href="{{ route('edit_post', $report->id) }}" target="_blank">
                            {{ $report->title }}
                        </a>
                    </td>
                    <td>
                        <span class="badge badge-pill bg-red">
                            {{ $report->reports()->count() }}
                        </span>
                    </td>
                    <td class="text-reset">{{ $report->created_at }}</td>
                    <td>
                        <a href="{{ route('delete_post', $report->id) }}" onclick="return confirm('You will delete this post, are you sure?');" class="btn btn-sm btn-icon btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                    </td>
                </tr>
                @endif
                
                @empty
                <td>{{ __('There are no reports.') }}</td>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $reports->links() }}
    
</div>
@endsection('content')