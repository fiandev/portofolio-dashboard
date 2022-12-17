@extends("dashboard.layout.main")

@section("head")
<link rel="stylesheet" href="{{ url('/css/inbox.css') }}">
@endsection

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <div class="d-flex justify-content-between">
    <div class="d-flex flex-column">
      <h1 class="fs-5">from : <span id="from">{{ $inbox->sender }}</span></h1>
      <small>on {{ $inbox->created_at->diffForHumans() }}</small>
    </div>
    <form action="{{ url()->current() }}" onsubmit="return confirm('are you sure?, this inbox will be delete!')" method="post">
      @csrf
      @method("delete")
      <button class="btn text-danger" type="submit">
        <i class="fa fa-trash"></i>
      </button>
    </form>
  </div>
</div>
<div class="col-12 inbox-container">
  <div class="inbox-content">
    <p>{{ $inbox->message }}</p>
  </div>
  <a class="btn btn-info my-4" href="{{ url()->previous () }}">back</a>
</div>
@endsection

@section("script")
<script>
  $(document).ready(() => {
    let from = $("#from").html()
    let exp = /^\w+@\w+.[a-z]{2,3}.?(\w[a-z])/g
    if (exp.test(from)) {
      $(".inbox-container").append(`
        <a class="btn btn-primary my-4" href="mailto:${ from }">
          reply
        </a>`)
    }
  })
</script>
@endsection