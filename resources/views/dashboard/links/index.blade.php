@extends("dashboard.layout.main")

@section("head")
<link href="{{ url('/css/icon-color.css') }}" rel="stylesheet">
@endsection

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">total links ({{ $links->count() }}) !</h1>
   <button id="btnAddSkill" ref="/links/create" class="btn btn-primary mb-3">
     add new link
   </button>
   <button class="btn btn-primary mb-3 w-50" type="button" id="btnCancelAddSkill">cancel</button>
   <form id="addSkill" action="{{ url()->current() }}" method="post" accept-charset="utf-8" class="d-flex flex-column gap-1 d-none col-md-8 col-lg-9">
     @csrf
     <label id="label-type" for="type">
       type link
     </label>
     <select class="form-control" name="type" id="type">
       @foreach($types as $type)
         <option value="{{ $type }}">
           {{ $type }}
         </option>
       @endforeach
     </select>
     <label id="label-url" for="url">
       url
     </label>
     <input type="text" class="form-control" name="url" id="url">
     <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit">add</button>
   </form>
</div>
  @if($links->count() >= 1)
    <div class="col-12">
      <div class="table-responsive">
      @if(session("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session("success") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      
      @error("type")
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @enderror
      @error("url")
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @enderror
        
      @if(session("error"))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session("error") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">uid</th>
              <th scope="col">type</th>
              <th scope="col">url</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($links as $link)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $link->uid }}</td>
                <td class="text-center">
                  <i class="fa-brands fa-{{ $link->type }}"></i>
                </td>
                <td>
                  <a href="{{ $link->url }}">
                    {{ $link->url }}
                  </a>
                </td>
                <td>
                  <form action="{{ url('/skills/'.$link->uid) }}" method="post" accept-charset="utf-8">
                    @method("delete")
                    @csrf
                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('are you sure ?, link {{ $link->uid }} will be delete!')">
                      <i data-feather="x-circle"></i>
                    </button>
                  </form>
                  <a class="badge bg-info" href="{{ url('/links/'.$link->uid.'/edit') }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  @else
    @include("partials.empty")
  @endif
      <!-- pagination-->
      <div class="overflow-scroll d-flex justify-content-center">
        {{ $links->onEachSide(0)->links() }}
      </div>
      <!-- end pagination-->
    </div>
@endsection

@section("script")
<script src="{{ url('js')}}/dash-skill.js" type="text/javascript" charset="utf-8"></script>
<script>
  $("#percentage").on("input", function () {
    let value = $(this).val()
   $("#label-percentage span").html(`${value}% of 100%`)
  })
</script>
@endsection