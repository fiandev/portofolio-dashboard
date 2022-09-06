@extends("dashboard.layout.main")

@section("head")
<!-- trix editor --->
<link rel="stylesheet" type="text/css" href="/css/trix.css">
<script type="text/javascript" src="/js/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section("container")
  <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>edit link</h1>
  </div>
  <div class="col-md-10">
    <form class="mb-3" action="{{ url('/links/'. $link->uid) }}" method="post" enctype="multipart/form-data">
      @method("put")
      @csrf
      <div class="mb-3">
        <label for="type" class="form-label">name</label>
        <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
          @foreach($types as $type)
            @if($link->type === $type)
              <option selected value="{{ old('type', $link->type) }}">{{ old('type', $link->type) }}</option>
            @else
              <option value="{{ $type }}">{{ $type }}</option>
            @endif
          @endforeach
        </select>
        @error("type")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
       <label for="url">
         url
       </label>
       <input type="text" value="{{ $link->url }}" class="form-control" name="url" id="url">
        @error("url")
        <p class="text-danger">
          {{ $message }}
        </p>
        @enderror
      </div>
      <div class="mb-3">
        <label for="uid" class="form-label">uid</label>
        <input value="{{ old('uid', $link->uid) }}" type="text" class="form-control @error('uid') is-invalid @enderror" id="uid" name="uid">
        @error("uid")
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <button type="submit" class="btn btn-primary">
        update
      </button>
      <a href="{{ url()->previous() }}" class="btn btn-info">
        back
      </a>
    </form>
  </div>
@endsection

@section("script")
<script src="/js/img-preview.js" type="text/javascript" charset="utf-8"></script>
<script>
  $("#url").on("input", function () {
    let value = $(this).val()
   $("#label-url span").html(`${value}% of 100%`)
  })
</script>
@endsection