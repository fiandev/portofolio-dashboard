@extends("layout.main")

@section("head")
<title>{{ $title ?? "login" }}</title>
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
    <main class="form-signin my-3">
      <h1 class="h3 my-3 fw-normal text-center">Please Login</h1>
      @if(session("loginError"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session("loginError") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <form action="{{ url()->full() }}" method="post">
        @csrf
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Example@example.com">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-2">
          <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      </form>
    </main>
  </div>
</div>
@endsection