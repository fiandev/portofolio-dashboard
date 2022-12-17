@extends("dashboard.layout.main")

@section("head")
<link rel="stylesheet" href="{{ url('/css/inbox.css') }}">
@endsection

@section("container")

<div class="pt-3 pb-2 mb-3 px-2 border-bottom d-flex flex-column gap-2">
   <h1 class="h2 text-capitalize">total message ({{ $inboxes->count() }}) !</h1>
   @if($inboxes->count() > 0)
     <form action="{{ route('user.inbox') }}" method="post" accept-charset="utf-8" class="col-8 col-md-8 col-lg-9" onsubmit="return confirm('are you sure ?, all inbox will be mark as has been read!')">
       @csrf
       <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit">mark all has been read</button>
     </form>
     <form action="{{ route('user.inbox') }}" method="post" accept-charset="utf-8" class="col-8 col-md-8 col-lg-9" onsubmit="return confirm('are you sure ?, all inbox will be deleted!')">
       @csrf
       @method("delete")
       <button class="btn btn-danger d-flex justify-content-center align-items-center" type="submit">delete all</button>
     </form>
   @endif
</div>
  @if($inboxes->count() >= 1)
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
        <div class="d-flex flex-column gap-2">
        @foreach($inboxes as $inbox)  
          <a class="d-flex justify-content-between align-self-start inbox {{ !$inbox->hasRead ? 'new' : '' }}" href="{{ url('/inbox/'. $inbox->uid) }}">
            <div class="d-flex flex-column">
              <h1 class="fs-5 m-0">{{ $inbox->sender }}</h1>
              <p class="text-muted">{{ \Illuminate\Support\Str::words($inbox->message, 3) }}</p>
            </div>
            <form class="d-flex align-items-center" action="{{ url('/inbox/'.$inbox->uid) }}" onsubmit="return confirm('are you sure?, this inbox will be delete!')" method="post">
              @csrf
              @method("delete")
              <button class="btn text-danger" type="submit">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </a>
        @endforeach
        </div>
      </div>
  @else
    @include("partials.empty")
  @endif
      <!-- pagination-->
      <div class="overflow-scroll d-flex justify-content-center">

      </div>
      <!-- end pagination-->
    </div>
@endsection