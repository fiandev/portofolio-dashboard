@extends("layout.main")

@section("head")
<title>{{ $title }}</title>
@endsection

@section("css")
<style>
  .container .row {
    min-height: 100vh;
  }
</style>
@endsection

@section("container")
<div class="row justify-content-center align-items-center">
  <div class="col-10 col-md-8 col-lg-6 shadow-lg rounded">
    <main class="form-signin">
      @if(session("message"))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          {{ session("message") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session("error") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <h1 class="h3 my-3 fw-normal text-center title">verify your email!</h1>
      <form id="form-verify-email" action="{{ url()->full() }}" method="post">
        @csrf
        <div class="form-floating mb-3">
          <input required value="" type="number" name="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="xxxxxx" id="otp-code">
          <label for="otp-code">OTP code</label>
          @error("otp")
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">send</button>
        
        <small class="d-block text-center text-capitalize my-3">
          <p>
            not received code ? <a href="#" id="reSendCode">resend code</a>
          </p>
          
        </small>
      </form>
    </main>
  </div>
</div>
@endsection

@section("script")
<script>
  const url = "{{ route('otp.get') }}";
  const email = "{{ $user->email }}";
  
  $("#otp-code").on("input", function(){
    let value = $(this).val();
    if ( value.length === "6" ) {
      $("#form-verify-email")[0].submit();
    }
  })
  
  $("#reSendCode").on("click", function(){
    $.post(url, {
      email: email
    }).then((response) => {
      if (response.status) showAlert(response.message);
    }).catch((err) => {
      showAlert(`can't re-send OTP code to ${ email }`, "danger");
    })
  })
  
  function showAlert(message, type = "info") {
    $(".title").before(`
      <div class="alert alert-${ type } alert-dismissible fade show" role="alert">
        ${ message }
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `)
  }
</script>
@endsection