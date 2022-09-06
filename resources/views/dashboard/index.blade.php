@extends("dashboard.layout.main")

@section("head")
<style type="text/css" media="all">
  .chart-container {
    position: relative;
    margin: auto;
    height: 40vh;
    width: 100%;
  }
</style>
@endsection

@section("container")
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">
    hi, {{ auth()->user()->name }} <span class="SayHi">👋</span>
  </h1>
</div>
<div class="d-flex gap-2 col-md-6 col-lg-5 flex-column">
  <div class="step-section">
    <h1 class="fs-4">how to use</h1>
    <ul class="steps">
      <li class="step">edit your profile</li>
      <li class="step">add skills</li>
      <li class="step">add your media social links</li>
      <li class="step">add a apikey</li>
    </ul>
  </div>
  <div class="step-section">
    <h1 class="fs-4">how to use Rest API</h1>
    <ul class="steps d-flex flex-column gap-2">
      <h1 class="fs-5">profile</h1>
      <ul class="steps">
        <li class="step form-group">
          <label for="api.profile" class="bg-success text-light px-2 py-1 rounded">GET</label>
          <input type="text" id="api.profile" readonly value="{{ url('/') }}/api/profile/:username?apikey<YOUR APIKEY>" class="form-control">
        </li>
      </ul>
      <h1 class="fs-5">inbox</h1>
      <ul class="steps d-flex flex-column gap-2">
        <li class="step form-group">
          <label for="api.profile" class="bg-success text-light px-2 py-1 rounded">GET</label>
          <input type="text" id="api.profile" readonly value="{{ url('/') }}/api/inbox/:username?apikey<YOUR APIKEY>" class="form-control">
        </li>
        <li class="step form-group">
          <label for="api.profile" class="bg-warning text-light px-2 py-1 rounded">POST</label>
          <input type="text" id="api.profile" readonly value="{{ url('/') }}/api/inbox/:username?apikey<YOUR APIKEY>" class="form-control">
        </li>
      </ul>
    </ul>
  </div>
</div>
@endsection

@section("script")

@endsection