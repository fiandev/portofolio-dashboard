@component('mail::message')
### OTP code
your OTP code is <b>{{ $otp->code }}</b>

Or You can verify your email just click this button below
@component('mail::button', ['url' => url("/register/verify/$otp->uid/")])
  <span class="text-capitalize btn btn-primary">verification account</span>
@endcomponent
 
<p>Thanks for your attention</p>
@endcomponent