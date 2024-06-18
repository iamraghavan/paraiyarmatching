@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://res.cloudinary.com/dwvybvefy/image/upload/v1718696654/logo-b_ooqieo.png" class="logo" alt="Bumble Bees Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
