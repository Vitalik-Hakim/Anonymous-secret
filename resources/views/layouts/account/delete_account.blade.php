@extends('layouts.app')
@section('content')
<!--
* Latest Items Section
-->
<div class="page-header text-white d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">
                {{ __('main.account_settings') }}
            </h2>
            <div class="page-pretitle">
                {{ __('main.account_hi_name', ['name' => Auth::user()->name]) }}
            </div>
        </div>
    </div>
</div>

<!-- Row -->
<div class="row row-cards">
    
    <div class="col-lg-3">
        @include('layouts.account.sidebar_settings')
    </div>

    <div class="col-lg-9">
        <div class="card shadow">
            <div class="card-body">
                
                <div class="empty">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.274 10.291a4 4 0 1 0 -5.554 -5.58m-.548 3.453a4.01 4.01 0 0 0 2.62 2.65" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 1.147 .167m2.685 2.681a4 4 0 0 1 .168 1.152v2" /><line x1="3" y1="3" x2="21" y2="21" /></svg>
                    </div>
                    
                    <p class="empty-title">
                        {{ __('auth.this_action_is_irreversible') }}
                    </p>
                    <p class="empty-subtitle text-muted">
                        {{ __('auth._all_content_deleted') }}
                    </p>
  
                    <div class="empty-action">
                        <form action="{{ url('/settings/delete/me') }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('{{ __('auth.are_you_sure') }}');" class="btn btn-link text-red strong mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.274 10.291a4 4 0 1 0 -5.554 -5.58m-.548 3.453a4.01 4.01 0 0 0 2.62 2.65" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 1.147 .167m2.685 2.681a4 4 0 0 1 .168 1.152v2" /><line x1="3" y1="3" x2="21" y2="21" /></svg> {{ __('main.btn_delete_account') }}
                            </button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection('content')