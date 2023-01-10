@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
{{-- button-{{ $color }} --}}
<a href="{{ $url }}" class="button text-blueblack" style="letter-spacing:1.9px;background-color:#C4F4FE;padding: 1.2rem 1.6rem;border-radius:.5rem" target="_blank" rel="noopener"><b>{{ $slot }}</b></a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
