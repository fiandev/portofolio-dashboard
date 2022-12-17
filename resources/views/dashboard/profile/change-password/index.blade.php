@extends("dashboard.layout.main")

@section("head")
<style>
  #about {
    min-height: 20vh;
    max-height: 50vh;
  }
</style>
@endsection
@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">change password</h1>
</div>
<div class="col-md-10 col-lg-8">
  @if(session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if(session("error"))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      {{ session("error") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <form id="formChangePassword" class="p-2" action="{{ route('user.changePassword') }}" method="post" accept-charset="utf-8" class="text-capitalize" enctype="multipart/form-data">
    @csrf
    <div class="form-floating mb-3">
      <input type="text" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" value="{{ old('newPassword') }}" id="newPassword">
      <label for="newPassword">new password</label>
      @error("newPassword")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" value="{{ old('confirmPassword') }}" id="confirmPassword">
      <label for="confirmPassword">confirm new password</label>
      @error("confirmPassword")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" id="password">
      <label for="password">enter your password</label>
      @error("password")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">
      submit
    </button>
    <a class="btn btn-info" href="{{ route('user.account') }}">back</a>
  </form>
</div>
@endsection

@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
   $("input").attr("autocomplete", "off")
   
   /* confirm password */
   $("#confirmPassword").on("input", (e) => {
     if ( $("#confirmPassword").val() !== $("#newPassword").val() ) {
       $("#confirmPassword").addClass("is-invalid")
     } else {
       $("#confirmPassword").removeClass("is-invalid")
     }
   })
   
   /* check new password */
   $("#newPassword").on("input", function(){
     let pass = $(this).val()
     let message = null
     if(/^([a-zA-Z0-9]+|\W){7}/gm.test(pass)) message = "strong"
     if(/([a-z]+|[A-Z0-9]){7}/gm.test(pass)) message = "strong enough"
     if (/^([a-z]+){7}/gm.test(pass)) message = "weak"
     $(this).addClass("is-valid")
     $("#newPassword ~ .valid-feedback").html(message)
   })
  })
</script>

@endsection