@extends('project.layout.master')
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
   
   @if(!$products->where('is_featured',1)->isEmpty())
      <div class="col-md-12 no-padding">
        <div class="fp">
          <div class="fp-head"><h2>featured products</h2></div>
          <div id="owl-demo" class="owl-carousel owl-theme">
          @foreach($products->where('is_featured',1) as $product)
           <div class="item clearfix"><a href="{{url('product/'.$product->slug)}}"><img src="{{$product->imageUrl()}}"><h4>{{$product->name}}</h4><h6><div class="line-through">{{$product->price}} {{$product->currency}}</div></h6><h6>{{$product->discountedPrice()}} {{$product->currency}}</h6></a></div>
           @endforeach
               
            </div>
        </div>
      </div>
    @endif
    

    @if(!$products->isEmpty())
      <div class="col-md-12 no-padding">
        <div class="col-md-3 no-padding">
           <div class="pdct-fil">
             <ul>
               <li><a href="{{url('category/'.$products->first()->category->slug.'?type=new')}}"> <i class="fa fa-star-o"></i> New  products !</a></li>
               <li><a href="{{url('category/'.$products->first()->category->slug.'?type=best-selling')}}"> <i class="fa fa-tag"></i> Best selling</a></li>
               <li><a href="{{url('category/'.$products->first()->category->slug.'?type=best')}}">  <i class="fa fa-check"></i> Best products</a></li>
             </ul>
           </div>
        </div>
        
        <div class="col-md-9 no-padding">
          <div class="pdct-view">
             <ul class="clearfix">
             @foreach($products as $product)
             <li>
               <img src="{{$product->imageUrl()}}">
               <h4>{{$product->name}}</h4><h6><div class="line-through">{{$product->price}} {{$product->currency}}</div></h6><h6>{{$product->discountedPrice()}} {{$product->currency}}</h6>
               <a href="{{url('product/'.$product->slug)}}" class="add-cart">View Details<div class="ic"><i class="fa fa-plus"></i></div></a>
             </li>

             @endforeach
             </ul>
          </div>
        </div>
        
      </div>
      @else
        <h3 class="text-center">No data to display</h3>
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

@endsection