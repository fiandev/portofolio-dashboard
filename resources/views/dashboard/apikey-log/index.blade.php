@extends("dashboard.layout.main")

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">total logs ({{ $logs->count() }}) !</h1>
   <select name="sortby" id="sortby" class="form-select w-auto">
     @foreach($listSort as $item)
       @if($item === $sortby)
         <option value="{{ $item }}" selected>{{ $item }}</option>
       @else
         <option value="{{ $item }}">{{ $item }}</option>
       @endif
     @endforeach
   </select>
</div>
  @if($logs->count() >= 1)
    <div class="col-12">
      <div class="mb-3 p-2">
        @if(session("success"))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session("error"))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("error") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="table-responsive">
          @foreach($logs as $log)
            <small>{{ $log->created_at->diffForHumans() }}</small>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  @foreach($log->data as $key => $item)
                    <th scope="col">{{ $key }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                  <tr>
                    @foreach($log->data as $item)
                      <td class="text-center">
                        {{ gettype($item) === "array" ? $item[0] : $item }}
                      </td>
                    @endforeach
                  </tr>
              </tbody>
            </table>
          @endforeach
        </div>
        {{ $logs->onEachSide(0)->withQueryString()->links() }}
      </div>
      @else
        @include("partials.empty")
      @endif
      <div class="d-flex gap-2">
        <a href="{{ url('/apikey') }}" class="btn btn-info">
          back
        </a>
        @if($logs->count() > 0)
          <form action="{{ url()->current() }}" method="post">
            @csrf
            @method("delete")
            <button class="btn btn-danger" type="submit">clear</button>
          </form>
        @endif
      </div>
    </div>
@endsection

@section("script")
<script src="{{ url('js')}}/dash-skill.js" type="text/javascript" charset="utf-8"></script>
<script>
  $("#sortby").on("change", function(){
    let currentUrl = new URL(window.location.href)
    
    if (currentUrl.searchParams.has("sortby")) currentUrl.searchParams.set("sortby", $(this).val())
    else currentUrl.searchParams.append("sortby", $(this).val())
    
    /* redirect */
    window.location.href = currentUrl.href || currentUrl.toString()
  })
  $("#percentage").on("input", function () {
    let value = $(this).val()
   $("#label-percentage span").html(`${value}% of 100%`)
  })
</script>
@endsection
<script>
  
</script>