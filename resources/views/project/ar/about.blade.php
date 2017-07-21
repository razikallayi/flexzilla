@extends('project.ar.layout.master')
@section('content')

<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>ABout <span> US </span> </h2>
    </div>
  </div>
</div>


<div class="abt-sec">
  <div class="container">
     <div class="col-md-12 no-padding">
        <div class="row">
           <div class="col-md-6">
              <h1> <span> MAke it a </span> <br> lifestyle </h1>
              <h3> not a duty </h3> 
           </div>
           
           <div class="col-md-6 abt-sec-rgt">
              <h2> About US </h2>
              <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make....</h6>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
           </div>
           
        </div>
     </div>
  </div>
</div>

<div class="sec2">
<div class="john-doe"><img src="{{url('project/images/john-doe.jpg')}}" class="img-responsive"></div>
  <div class="container">
     <div class="col-md-12 no-padding">
        <div class="row">
           <div class="col-md-6">
            <div class="sec2-sec">
              <h2>mr.JOHN DOE </h2>
              <h5>The Founder</h5>
              <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since...</h6>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining  sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p>
<p>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>

<img src="{{url('project/images/sign.jpg')}}">

</div>
           </div>
        </div>
     </div>
     
     <div class="col-md-12 no-padding">
        <div class="abt-slider">
            <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item clearfix"><img src="{{url('project/images/abt-slider1.jpg')}}"></div>
                <div class="item clearfix"><img src="{{url('project/images/abt-slider1.jpg')}}"></div>
                <div class="item clearfix"><img src="{{url('project/images/abt-slider1.jpg')}}"></div>
                <div class="item clearfix"><img src="{{url('project/images/abt-slider1.jpg')}}"></div>
                <div class="item clearfix"><img src="{{url('project/images/abt-slider1.jpg')}}"></div>
                <div class="item clearfix"><img src="{{url('project/images/abt-slider1.jpg')}}"></div>
            </div>
        </div>
     </div>
     
  </div>
</div>





@endsection

@section('scripts')
@parent

<script src="{{url('project/js/owl.carousel.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function() {
 $("#owl-demo").owlCarousel({
	margin: 10,
	nav: true,
	loop: false,
	autoplay:true,
	dots:false,
    autoplayTimeout:6000,
	autoplayHoverPause:true,
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 1
	  },
	  1000: {
		items: 1
	  }
	}
  })
   $( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 $( ".owl-next").html('<i class="fa fa-angle-right"></i>');
})

</script>


@endsection