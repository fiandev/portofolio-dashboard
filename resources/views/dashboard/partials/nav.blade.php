<header class="navbar navbar-dark fixed-top bg-dark d-flex align-items-center flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 d-flex gap-1 align-items-center" href="{{ route('dashboard') }}">
    <img class="img-fluid avatar-dashboard" src="{{ auth()->user()->photo ? url(auth()->user()->photo) : url('post-images/no-pp.jpg') }}" alt="" />
    {{ auth()->user()->username != null ? Illuminate\Support\Str::words(auth()->user()->username, 3) : "" }}
    </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>