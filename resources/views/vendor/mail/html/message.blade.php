@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => env('APP_URL')])
@lang('mail.app_name')
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} @lang('mail.app_name'). @lang('mail.all_rights_reserved')
@endcomponent
@endslot
@endcomponent
