@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'DesaGo')
<img src="https://londa-proinsurance-nonsalubriously.ngrok-free.dev/img/logo-desago.png" class="logo" alt="DesaGo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
