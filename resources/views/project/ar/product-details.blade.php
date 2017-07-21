@extends('project.ar.layout.master')
@section('content')


<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>Our <span> Products </span> </h2>
    </div>
  </div>
</div>

<div class="pdct">
   <div class="container">
      
      <div class="col-md-12 no-padding">
         <div class="pdct-slider clearfix">
            <div class="col-md-7 no-padding">
               <div class="item">            
            <div class="clearfix">
                <ul id="vertical" class="gallery list-unstyled ">                
                @foreach($product->medias as $media)
                <li data-thumb="{{$product->imageUrl($media->image)}}" ata-src="{{$product->imageUrl($media->image)}}"> 
                  <img src="{{$product->imageUrl($media->image)}}" />
                </li>
                @endforeach
                </ul>
            </div>
        </div>
            </div>
            
            
            <div class="col-md-5 no-padding">
               <div class="pdct-head">
                 <h2>{{$product->translate('name')}}</h2>
                 <p>{{$product->translate('brief')}}</p>
               </div>
               
               <div class="prc">
                 <h2 class="cross">{{$product->price}} {{$product->currency}}</h2>
                 <h2>{{$product->discount}} {{$product->currency}}</h2>
               </div>
               
               <a id="AddToCartBtn" onclick ="cart.addToCart({{$product->id}})" class="wa-vl" href="javascript:void(0);"><div class="vl">Add to cart </div><div class="ic"><i class="fa fa-plus"></i></div></a>
               
            </div>
            
         </div>
      </div>
      
      <div class="col-md-12 no-padding">
             <div class="tabs">
  <div class="tab">
    <div class="tab-toggle"><i class="fa fa-star-o"></i> Description</div>
  </div>
  <div class="content">
    <p>{{$product->translate('description')}}</p>
  </div>
  <div class="tab">
    <div class="tab-toggle"><i class="fa fa-tag"></i> Specifications</div>
  </div>
  <div class="content">
    <p>{{$product->translate('specifications')}}</p>
  </div>
  
  
</div>
          </div>

          @inject('Products','App\Models\Product')
          @php
          $products = $Products->where('is_featured',1)->where('id','!=',$product->id)->where('is_featured',1)->where('product_category_id',$product->product_category_id)->get();
          @endphp
          @if(!$products->where('is_featured',1)->isEmpty())
          <div class="col-md-12 no-padding">
            <div class="fp">
              <div class="fp-head"><h2>featured products</h2></div>
              <div id="owl-demo" class="owl-carousel owl-theme">
                @foreach($products->where('is_featured',1)->where('is_featured',1) as $featured_product)
                <div class="item clearfix"><a href="{{url('product/'.$featured_product->slug)}}"><img src="{{$featured_product->imageUrl()}}"><h4>{{$featured_product->name}}</h4><h6><div class="line-through">{{$featured_product->price}} {{$featured_product->currency}}</div></h6><h6>{{$featured_product->discountedPrice()}} {{$featured_product->currency}}</h6></a></div>
                @endforeach
              </div>
            </div>
          </div>
          @endif
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
		items: 2
	  },
	  1000: {
		items: 4
	  }
	}
  })
   $( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 $( ".owl-next").html('<i class="fa fa-angle-right"></i>');
})

</script>
    <script src="{{url('project/js/lightslider.js')}}"></script> 
    <script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
             $(document).ready(function() {
    $('#vertical').lightSlider({
      gallery:true,
      item:1,
      vertical:true,
      verticalHeight:415,
      vThumbWidth:80,
      thumbItem:4,
      thumbMargin:4,
      slideMargin:0
    });  
  });
		});
    </script>
    
    <script>
      wrapper = $('.tabs');
      tabs = wrapper.find('.tab');
      tabToggle = wrapper.find('.tab-toggle');
      function openTab() {
        var content = $(this).parent().next('.content'), activeItems = wrapper.find('.active');
        if (!$(this).hasClass('active')) {
          $(this).add(content).add(activeItems).toggleClass('active');
          wrapper.css('min-height', content.outerHeight());
        }
      };
      tabToggle.on('click', openTab);
      $(window).load(function () {
        tabToggle.first().trigger('click');
      });

    </script>



<script>
  var cart = {};
  cart.addToCart = function (id){
    event.preventDefault();
    quantity = $('#quantity').val();
    $.ajax({
        url: "{{ url('product/updatecart')}}",
        type: 'POST',
        data:{id:id,quantity:quantity},
        success: function(data){
          $('#cartCount').html(data.cartCount);
          if(data.cartCount > 0){
            $('#cartCount').addClass('badge');
          }else{
            $('#cartCount').removeClass('badge');
          }
          showSnackbar('Added to cart');
          // $('#AddToCartBtn').html("Update Cart");
        },
        error: function(){
          showSnackbar('Adding to cart failed');
        }
    });
  }
</script>



<script type="text/javascript">
//Used for all Ajax posts
// CSRF protection
  $.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@endsection