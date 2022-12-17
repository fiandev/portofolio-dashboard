@extends("dashboard.layout.main")

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom">
   <h1 class="h2 text-capitalize">total skills ({{ $skills->count() }}) !</h1>
   <button id="btnAddSkill" ref="/skills/create" class="btn btn-primary mb-3">
     add new skills
   </button>
   <button class="btn btn-primary mb-3 w-50" type="button" id="btnCancelAddSkill">cancel</button>
   <form id="addSkill" action="{{ url()->current() }}" method="post" accept-charset="utf-8" class="d-flex flex-column gap-1 d-none col-md-8 col-lg-9">
     @csrf
     <input class="form-control" placeholder="name of skill" type="text" name="name" id="name" value="" />
     <label id="label-percentage" for="percentage">
       percentage <span>0% of 100%</span>
     </label>
     <input type="range" value="1" min="0" max="100" class="form-range" name="percentage" id="percentage">
     <textarea placeholder="skill description" name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
     <button class="btn btn-primary w-auto" type="submit">add</button>
   </form>
</div>
  @if($skills->count() >= 1)
    <div class="col-12">
      <div class="table-responsive">
      @if(session("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session("success") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      
      @error("name")
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
              <th scope="col">name</th>
              <th scope="col">level</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($skills as $skill)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $skill->name }}</td>
                <td>{{ $skill->level }}</td>
                <td>
                  <form action="{{ url('/skills/'.$skill->uid) }}" method="post" accept-charset="utf-8">
                    @method("delete")
                    @csrf
                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('are you sure ?, skill {{ $skill->name }} will be delete!')">
                      <i data-feather="x-circle"></i>
                    </button>
                  </form>
                  <a class="badge bg-info" href="{{ url('/skills/'.$skill->uid.'/edit') }}">
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
        {{ $skills->onEachSide(0)->links() }}
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