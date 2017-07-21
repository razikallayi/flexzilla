@extends('project.layout.master')
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

       {{-- <div class="col-md-4"><div class="brand-sec"><img src="images/tb1.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb2.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb3.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb4.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb3.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb4.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb2.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb4.png"></div></div>
       <div class="col-md-4"><div class="brand-sec"><img src="images/tb3.png"></div></div> --}}
    </div>
  </div>
</div>






@endsection
