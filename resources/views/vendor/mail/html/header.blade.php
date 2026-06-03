@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://i.ibb.co/3m2hQ2RQ/logo.png" class="logo" alt="Reen Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
