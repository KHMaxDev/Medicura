@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Medicura')
<img src="https://medicura.site/favicon.png" class="logo" alt="Medicura">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
