@extends("dashboard.layout.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">profile</h1>
</div>
<div class="col-md-10 col-lg-8">
  @if(session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session("success") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  @if(session("info"))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      {{ session("info") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  <form class="p-2" action="{{ route('user.account') }}" method="post" accept-charset="utf-8" class="text-capitalize" enctype="multipart/form-data">
    @csrf
    <input type="file" class="d-none" name="photo" id="photo" value="" />
    <div style="width: 12rem; height: 12rem" class="profile-frame border rounded mb-3 position-relative">
      <img data-src="{{ auth()->user()->photo ? url(auth()->user()->photo) : url('post-images/no-pp.jpg') }}" id="preview" style="height: 100%;width:100%" class="rounded-circle" src="{{ auth()->user()->photo ? url(auth()->user()->photo) : url('post-images/no-pp.jpg') }}" alt="{{ auth()->user()->name }}`s photo" />
      <label for="photo" class="rounded-circle position-absolute d-flex justify-content-center " style="bottom:0;right:0">
        <i class="fa fa-pencil fs-3"></i>
      </label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="john doe" value="{{ auth()->user()->name }}">
      <label for="floatingInput">name</label>
      @error("name")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->username }}">
      <label for="floatingInput">username</label>
      @error("username")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->email }}">
      <label for="floatingInput">Email</label>
      @error("email")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <textarea type="about" name="about" class="form-control @error('about') is-invalid @enderror" id="about" placeholder="Example@example.com">{{ auth()->user()->about }}</textarea>
      <label for="about">about</label>
      @error("about")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating mb-3">
      <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" id="floatingInput" placeholder="Example@example.com" value="{{ auth()->user()->birthdate ?? date('Y-m-d') }}">
      <label for="floatingInput">birthdate</label>
      @error("birthdate")
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">update profile</button>
    <a class="btn btn-info" href="{{ route('user.account') }}">back</a>
  </form>
  
  <form id="form-deleteAccount" class="p-2" action="{{ route('user.account') }}" method="post" accept-charset="utf-8">
    @csrf
    @method("delete")
    <h2 class="text-capitalize">
      delete account
    </h2>
    <button id="btn-deleteAccount" type="button" class="btn btn-danger">delete account</button>
  </form>
</div>
@endsection

@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $('#btn-deleteAccount').on('click',function(e){
      // e.preventDefault();
      var form = $(this).parents().find("#form-deleteAccount");
      console.log(form)
      swal({
          title: "Are you sure?",
          text: "your account will be delete!",
          icon: "warning",
          buttons: [
            'No',
            'Yes'
          ]
      }).then(function(isConfirm){
          if (isConfirm) { 
            form.submit();
          } else {
            swal({
              title: "Cancelled",
              text: "your account will not deleted",
              icon: "success"
            }).then(function(){
              
            });
          }
      });
    });
    $("#photo").on("change", function (event){
      var files = event.target.files,
                  file;
     if (files && files.length > 0) {
       file = files[0]
       try {
         let fileReader = new FileReader();
         let dataSrc = $("#preview").attr("data-src")
         fileReader.onload = function (e) {
           $("#preview").attr("src", e.target.result)
           console.log(e.target.result);
         };
         fileReader.readAsDataURL(file);
       } catch (e) {
         console.log("FileReader are not supported ");
       }
     }
     else {
       let dataSrc = $("#preview").attr("data-src")
       $("#preview").attr("src", dataSrc)
     }
    })
})
</script>

@endsection