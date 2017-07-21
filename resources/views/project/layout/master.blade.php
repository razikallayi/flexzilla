<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Flex Zilla</title>
@section('styles')
{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> --}}
<link rel="icon" href="{{url('project/images/favicon.ico')}}" type="image/x-icon">
<link rel="stylesheet" href="{{url('project/css/font-awesome.css')}}" type="text/css">
<link rel="stylesheet" href="{{url('project/css/bootsnav.css')}}" type="text/css">
<link rel="stylesheet" href="{{url('project/css/bootsnav.css')}}" type="text/css">

<link rel="stylesheet" href="{{url('project/css/bootstrap.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{url('project/css/stylesheet.css')}}" type="text/css">


<script src="{{url('project/js/jquery-2.1.0.min.js')}}"></script>
<script src="{{url('project/js/bootstrap.min.js')}}"></script>
@show
</head>

<body>
<header class="cd-auto-hide-header">
<div class="page-header">
  <div class="container">
     <div class="col-md-12 no-padding">
        <div class="head-lft">
          <ul>
            <li> <img src="{{url('project/images/icons/head-phn.png')}}"> +974 0123 4567</li>
            <li> <img src="{{url('project/images/icons/head-clck.png')}}"> mon - sat 8:00 / 21:00</li>
          </ul>
        </div>
        
        <div class="lan">
        @if(app()->isLocale('ar'))
         <a href="{{url('/')}}"> ENGLISH </a>
         @else
         <a href="{{url('/ar')}}"> العربية </a>
         @endif
        </div>
        
        <div class="social">
         <ul>
           <li><a href="#"><i class=" fa fa-facebook"></i></a></li>
           <li><a href="#"><i class=" fa fa-twitter"></i></a></li>
           <li><a href="#"><i class=" fa fa-youtube"></i></a></li>
         </ul>
        </div>
        
        <div class="menu">
          <ul>
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{url('about')}}">About</a></li>
            <li><a href="{{url('contact')}}">Contact</a></li>
          </ul>
        </div>
        
     </div>
  </div>
</div>

<nav class="navbar navbar-default bootsnav">
    <div class="container">  
        
        <div class="attr-nav">
            <ul>
                <li class="dropdown">
                  <a href="{{url('cart')}}" >
                    <img src="{{url('project/images/cart-bag.svg')}}">
                    <span class="{{Cart::getContent()->count()>0?" badge ":""}}" id="cartCount">{{Cart::getContent()->count()>0?Cart::getContent()->count():""}}
                    </span>
                  </a> 
                </li>
            </ul>
        </div>        


        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('project/images/flex-logo.png')}}" class="logo" alt=""></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
            @inject('Categories', 'App\Models\ProductCategory')
            @foreach($Categories->all() as $category)
               <li><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
            @endforeach
           
            </ul>
        </div>
    </div>   
</nav>
</header>


@yield('content')


<footer>
  <div class="container">
    <div class="col-md-12 no-padding">
       <div class="row">
         <div class="col-md-3">
           <div class="nl">
              <img src="{{url('project/images/logo-ftr.png')}}">
              <h4>Subscribe Your News Letter</h4>
              <form id="Subscribe" name="Subscribe">
                <div class="input-group">
  <span class="input-group-addon" id="basic-addon1"><img src="{{url('project/images/em.png')}}"></span>
  <input type="email" name="subscriber_email" required placeholder="Enter your email" class="form-control" aria-describedby="basic-addon1">
   <span onclick="subscribe()" class="input-group-addon" style="cursor: pointer;background-color:#ff0e00;color:white">Subscribe</span>
</div>
              </form>
              <p>Subscribe our Newsletter & Stay Updated</p>
           </div>
         </div>
         
         <div class="col-md-6">
           <div class="ie clearfix">
             <div class="col-md-6 no-padding">
                <h4>Informations</h4>
                <ul>
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li><a href="{{url('about')}}">About Us</a></li>
                  <li><a href="{{url('brands')}}">Brands</a></li>
                  <li><a href="{{url('terms')}}">Terms & Conditions</a></li>
                  <li><a href="{{url('privacy')}}">Privacy policy</a></li>
                  <li><a href="{{url('contact')}}">Contact Us</a></li>
                </ul>
             </div>
             
             <div class="col-md-6 no-padding">
                <h4>Extras</h4>
                <ul>
                @foreach($Categories->all() as $category)
                <li><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
                @endforeach
                </ul>
             </div>
             
           </div>
         </div>
         
         <div class="col-md-3">
           <div class="social-ftr">
           <h4>Get in touch</h4>
             <ul>
               <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
               <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
               <li><a href="#"><i class="fa fa-google-plus"></i> Google +</a></li>
               <li><a href="#"><i class="fa fa-youtube"></i> YouTube</a></li>
             </ul>
           </div>
         </div>
         
       </div>
    </div>
  </div>
</footer>

<div class="ftr-btm clearfix">
  <div class="container">
     <div class="col-md-12 no-padding">
        <div class="row">
           <div class="col-md-4 clearfix"><img src="{{url('project/images/map.png')}}"> <p>Flex Zilla <br> P.O Box 1234, Doha – Qatar </p></div>
           <div class="col-md-4 clearfix"><a href="#"><img src="{{url('project/images/msg.png')}}" class="lft"> <h4>Info@flexzilla.com</h4></a></div>
           <div class="col-md-4 clearfix"><img src="{{url('project/images/mob.png')}}"> <h4>Tel:   (974) 0000 0000 </h4></div>
        </div>
     </div>
  </div>
</div>

<div class="cp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <div class="cp-lft">© 2016 Flexzilla. All Rights Reserved.</div>
      <div class="cp-rgt">Powered by      <a href="http://www.whytecreations.com/" target="_blank" rel="dofollow"> <img src="{{url('project/images/whyte.png')}}">     Whyte Company </a></div>
    </div>
  </div>
</div>

<div class='toast' style='display:none'>Event asdas das</div>

<div id="Popup" class="modal fade" style="z-index: 20000" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- The actual snackbar -->
<div id="snackbar"></div>

@section('scripts')
<script src="{{url('project/js/modernizr.js')}}" type="text/javascript"></script>
<script src="{{url('project/js/bootsnav.js')}}"></script>

<script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    ]) !!};
  </script>


  <script type="text/javascript">
    function showSnackbar(message) {
      var snackBar = document.getElementById("snackbar")
      snackBar.className = "show";
      snackbar.innerHTML=message;
      setTimeout(function(){ 
        snackBar.className = snackBar.className.replace("show", "");
        snackbar.innerHTML;
      }, 3000);
    }
  </script>

<script type="text/javascript">

  function subscribe(){
    var email = $('input[name=subscriber_email]').val();
    
    if(validateEmail(email)){
      $('#Subscribe').submit();
    }else{
      popup('<div class="alert"><ul>Please enter valid email!</ul></div>')
    }
  }

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  function popup(message){
    $('.error').html(message);
    $('.error').fadeIn(400).delay(3000).fadeOut(400); //fade out after 3 seconds
    // $('#Popup .message').html(message);
    // $('#Popup').modal();
  }
  
  $(function(){
    $('#Subscribe').submit(function(event) {
      event.preventDefault();
      var formData = {
        'email'      : $('input[name=subscriber_email]').val()
      };
      var message;
      $.ajax({
        type        : 'POST',
        url         : '{{url('subscribe')}}',
        data        :  formData, 
        dataType    : 'json', // what type of data do we expect back from the server
        encode          : true,
        success: function(data){
          if(data.status=="success"){
            message= "Thank you for subscribing! You will be notified when we publish news.";
          }
          else{
            message= "Sorry! Couldnot subscribe.";
          }
        },
        error: function(data){
          if(data.status == 422){
            var errors = data.responseJSON;
            errorsHtml="";
            $.each( errors , function( key, value ) {
              errorsHtml += '<li>' + value[0] + '</li>';
            });
            message = errorsHtml;
          }else{
            message = "Failed! Couldnot subscribe.";
          }
        },
        complete: function(){
          // popup('<div class="alert"><ul>'+message+"</ul></div>");
          popup(message);
          document.getElementById("Subscribe").reset();
        }
      })
    });
  });
</script>

<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-Token': Laravel.csrfToken
  }
});
</script>
@show


</body>
</html>
