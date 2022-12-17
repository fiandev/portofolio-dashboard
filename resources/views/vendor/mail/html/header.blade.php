<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === env("APP_NAME"))
  <img style="max-width: 50%" src="{{ url('icon.png') }}" class="img-fluid rounded-circle" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
