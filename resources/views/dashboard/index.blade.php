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
  <h1 class="h2">hi, {{ auth()->user()->name }} 👋</h1>
</div>
@endsection

@section("script")

@endsection