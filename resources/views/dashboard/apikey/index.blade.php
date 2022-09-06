@extends("dashboard.layout.main")

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">total apikeys ({{ $apikeys->count() }}) !</h1>
   <form id="addApikey" action="{{ url()->current() }}" method="post" accept-charset="utf-8" class="col-8 col-md-8 col-lg-9">
     @csrf
     <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit">add new apikey</button>
   </form>
</div>
  @if($apikeys->count() >= 1)
    <div class="col-md-8 col-lg-9">
      <div class="table-responsive">
      @if(session("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session("success") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      
      @error("limit")
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @enderror
        
        @if(session()->has("info"))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          {{ session("info") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">apikey</th>
              <th scope="col">used</th>
              <th scope="col">created at</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($apikeys as $key)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $key->key }}</td>
                <td>{{ $key->used }}</td>
                <td>{{ $key->created_at }}</td>
                <td>
                  <form action="{{ url('/apikey/'.$key->key) }}" method="post" accept-charset="utf-8">
                    @method("delete")
                    @csrf
                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('are you sure ?, apikey {{ $key->key }} will be delete!')">
                      <i data-feather="x-circle"></i>
                    </button>
                  </form>
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
        {{ $apikeys->onEachSide(0)->links() }}
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
<script>
  
</script>