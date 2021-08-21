@extends('layouts.app')
@section('content')
<!-- Row -->
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card">
            
            <div class="card-header">
                <h2 class="card-title">
                    {{ $page->title }}
                </h2>
            </div>
            
            <div class="card-body">
                
                {!! clean($page->body) !!}
                
            </div>
        </div>
    </div>
    
</div>
<!-- end Row -->
@endsection('content')