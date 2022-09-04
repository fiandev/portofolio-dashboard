@extends("dashboard.layout.main")

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">profile</h1>
</div>
<div class="privilages d-flex flex-column col-md-6 col-lg-5">
  @can("member")
  @endcan
  <div class="card">
    <img src="{{ $user->photo ? url($user->photo) : url('post-images/no-pp.jpg') }}" class="card-img-top" alt="{{ $user->name }}`s photo">
    <div class="card-body">
      <h5 class="card-title">
        {{ $user->name }}
      </h5>
      <p class="card-text">
        your name is {{ $user->name }}, you have a nickname {{ $user->username }}.
      </p>
    </div>
    
    @if($user->id === auth()->user()->id)
    <div class="card-body">
      <a href="{{ route('user.account.edit') }}" class="card-link">edit profile</a>
      <a href="{{ url('/') }}" class="card-link">
        back
      </a>
    </div>
    @endif
  </div>
</div>
@endsection