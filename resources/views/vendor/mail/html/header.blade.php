<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <span class="logo">
        @lang('mail.app_name')
    </span>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
