@extends('project.layout.master')
@section('content')


<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>Contact <span> US </span> </h2>
    </div>
  </div>
</div>
<div class="contact">
  <div class="gmap">
    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14429.840129219652!2d51.4992405!3d25.2887436!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sqa!4v1493468164163" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  <div class="container">
    <div class="col-md-12 no-padding">
      <div class="col-md-6 con-sec pull-right">
        <h2>Get in touch with us</h2>
        <h5>leave a message</h5>
        <form  method="post" action="{{url('contact')}}">
              {{csrf_field()}}
          <div class="form-group clearfix">
            <div class="input-group"> <span class="input-group-addon" id="basic-addon1"><img src="{{url('project/images/icons/con-name.png')}}"></span>
              <input type="text" required name="name" class="form-control" placeholder="Name" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group clearfix">
                <div class="input-group"> <span class="input-group-addon" id="basic-addon1"><img src="{{url('project/images/icons/con-mail.png')}}"></span>
                  <input type="email" required name="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group clearfix">
                <div class="input-group"> <span class="input-group-addon" id="basic-addon1"><img src="{{url('project/images/icons/con-phone.png')}}"></span>
                  <input type="number" name="phone" class="form-control" placeholder="Phone" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group clearfix">
          <div class="input-group"> <span class="input-group-addon" id="basic-addon1"><img src="{{url('project/images/msg-con.png')}}"></span>
                             <textarea class="form-control" required=""  name="message" placeholder="Message" aria-describedby="basic-addon1"></textarea>

                </div>
          </div>
          <div class="form-group clearfix">
            <button type="submit" class="con-sn">SEND NOW </button>
            @if(Session::has('mail_status'))
              &nbsp;&nbsp;<span class="lead">{{Session::get('mail_status')}}</span>
            @endif
          </div>
        </form>
        </form>
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