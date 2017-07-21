@extends('project.layout.master')
@section('content')

<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>Page Not Found!</h2>
    </div>
  </div>
</div>



<div class="tc">
  <div class="container">
    <div class="col-md-12 no-padding">
       <div class="tc-sec">
        <h4>please check the url!</h4>
        <a class="btn btn-lg btn-info" href="{{URL::previous()}}" >go back</a>
       </div>
    </div>
  </div>
</div>

@endsection