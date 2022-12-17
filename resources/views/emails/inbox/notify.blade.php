@component('mail::message')
# Received Inbox
## from <b>{{ $inbox->sender }}</b>
### on {{ $inbox->created_at }}

<hr>

<div style="min-height: 40vh">
  <p>
    message : {{ $inbox->message }}
  </p>
</div>

<hr>

@component('mail::button', ['url' => url('/inbox/'.$inbox->uid)])
  <span class="text-capitalize">
    view message
  </span>
@endcomponent

<p>Thanks for your attention</p>
@endcomponent