@props(['url'])
<tr>
<td class="header">
{{-- <a href="{{ $url }}" style="display: inline-block;"> --}}
<div href="{{ $url }}" style="display: inline-block;font-weight:bold;letter-spacing: 1.9px;font-size:1.2rem;">
{{-- @if (trim($slot) === 'Laravel') --}}
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
{{-- @else --}}
{{ $slot }}
{{-- @endif --}}
</div>
</td>
</tr>
