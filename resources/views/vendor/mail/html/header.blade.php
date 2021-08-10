<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="/images/logo ukm.png" class="logo" alt="Logo umkm">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
