@extends("dashboard.main")

@section("head")
<!-- trix editor --->
<link rel="stylesheet" type="text/css" href="/css/trix.css">
<script type="text/javascript" src="/js/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@can("justMember")
<style type="text/css" media="all">
  trix-toolbar [data-trix-button-group="file-tools"] {
    display: none;
  }
</style>
@endcan
@endsection
@section("container")
  <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>create new post!</h1>
  </div>
  <div class="col-md-10 p-2">
    @if(session("error"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session("error") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form class="mb-3" action="/dashboard/posts/" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input value="{{ old("title") }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title">
        @error("title")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input value="{{ old("slug") }}" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug">
        @error("slug")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">
          Category
        @can("admin")
        <i id="btnCategory" class="fa fa-sliders"></i>
        @endcan
        </label>
        @if(session()->has("error"))
          <input value="{{ old('category_id' ) }}" type="text" class="input-category form-control @error('category_id') is-invalid @enderror" name="category_id" placeholder="write new category..">
          <select name="" class="form-control input-category d-none">
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        @else
          <input value="" type="text" class="input-category form-control d-none" name="" placeholder="write new category..">
           <select name="category_id" class="form-control input-category">
            @foreach($categories as $category)
            @if(old("category_id") == $category->id)
            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach
          </select>
        @endif
        @error("category")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="image">Thumbnail</label>
        @error("image")
        <p class="text-danger">
          {{ $message }}
        </p>
        @enderror
        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" />
      </div>
      <div class="mb-3">
        <label for="body">Body</label>
        @error("body")
        <p class="text-danger">
          {{ $message }}
        </p>
        @enderror
        <input type="hidden" name="body" id="body" value="{{ old("body") }}" />
        <trix-editor input="body"></trix-editor>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  
@endsection
@section("script")
<script src="/js/img-preview.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  @can("admin")
  const title = document.querySelector("#title")
  const slug = document.querySelector("#slug")
  title.addEventListener("change", function(){
    fetch(`/dashboard/posts/checkSlug?title=${title.value}`)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  })
  $("#btnCategory").on("click",function(){
  document.querySelectorAll(".input-category").forEach((e) => {
    if( $(e).attr("name") != "" ){
      $(e).attr("name","");
      $(e).attr("id","");
    } else {
      $(e).attr("name","category_id");
      $(e).attr("id","category");
    }
  })
    $(".input-category").toggleClass("d-none");
  })
  @endcan
  @can("justMember")
  document.addEventListener("trix-file-accept", function(e){
    e.preventDefault()
  })
  @endcan
</script>
@endsection