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
      <h1 class="h3 my-3 fw-normal text-center">Registrasion Form</h1>
      <form action="{{ url()->full() }}" method="post">
        @csrf
        <div class="form-floating mb-3">
          <input required value="{{ old("name") }}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="john">
          <label for="floatingInput">Name</label>
          @error("name")
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-3">
          <input required value="{{ old("username") }}" type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="john doe">
          <label for="floatingInput">Username</label>
          @error("username")
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-3">
          <input required value="{{ old("email") }}" type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="example@example.com">
          <label for="floatingInput">Email</label>
          @error("email")
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-2">
          <input required type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
          @error("password")
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        
        <small class="d-block text-center text-capitalize my-3">
          <p>have registered ? <a href="/login/">login now!</a></p>
          
        </small>
      </form>
    </main>
  </div>
</div>
@endsection