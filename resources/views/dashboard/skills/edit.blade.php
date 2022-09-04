@extends("dashboard.layout.main")

@section("head")
<!-- trix editor --->
<link rel="stylesheet" type="text/css" href="/css/trix.css">
<script type="text/javascript" src="/js/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style type="text/css" media="all">
  trix-toolbar [data-trix-button-group="file-tools"] {
    display: none;
  }
</style>
@endsection

@section("container")
  <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>edit skill</h1>
  </div>
  <div class="col-md-10">
    <form class="mb-3" action="{{ url('/skills/'. $skill->uid) }}" method="post" enctype="multipart/form-data">
      @method("put")
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">name</label>
        <input value="{{ old("name", $skill->name) }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
        @error("name")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="uid" class="form-label">uid</label>
        <input value="{{ old('uid', $skill->uid) }}" type="text" class="form-control @error('uid') is-invalid @enderror" id="uid" name="uid">
        @error("uid")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
       <label id="label-percentage" for="percentage">
         percentage <span>{{ $skill->percentage }}% of 100%</span>
       </label>
       <input type="range" value="{{ $skill->percentage }}" min="0" max="100" class="form-range" name="percentage" id="percentage">
        @error("percentage")
        <p class="text-danger">
          {{ $message }}
        </p>
        @enderror
      </div>
      <div class="mb-3">
        <label for="description">description</label>
        @error("description")
        <p class="text-danger">
          {{ $message }}
        </p>
        @enderror
        <textarea class="form-control" name="description" id="description">{{ old("description", $skill->description) }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">
        update
      </button>
    </form>
  </div>
@endsection

@section("script")
<script src="/js/img-preview.js" type="text/javascript" charset="utf-8"></script>
<script>
  $("#percentage").on("input", function () {
    let value = $(this).val()
   $("#label-percentage span").html(`${value}% of 100%`)
  })
</script>
@endsection