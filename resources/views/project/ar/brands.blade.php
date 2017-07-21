@extends('project.ar.layout.master')
@section('content')


<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>Our <span> Brands </span> </h2>
    </div>
  </div>
</div>



<div class="brand">
  <div class="container">
    <div class="col-md-12 no-padding">
    @foreach($brands as $brand)
       <div class="col-md-4"><div class="brand-sec"><img src="{{$brand->imageUrl()}}"></div></div>
    @endforeach
    </div>
  </div>
</div>






@endsection
