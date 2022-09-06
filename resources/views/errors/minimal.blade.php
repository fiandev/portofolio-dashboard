@extends("layouts.main")

@section("head")
<title>@yield("code") | @yield("message")</title>
@endsection

@section("container")
<div class="content row">
  <div style="min-height: 40vh" class="d-flex flex-column align-items-center justify-content-center gap-2 overflow-visible">
      <div class="error-info d-flex flex-column align-items-center">
        <h1 class="fs-4">
          @yield("code")
        </h1>
        <p>
          @yield("message")
        </p>
      </div>
      <small class="text-muted">
        <a href="{{ url('/') }}">
          back to home
        </a>
        or
        <a href="{{ url()->current() }}">
          try visit again
        </a>
      </small>
  </div>
</div>
@endsection