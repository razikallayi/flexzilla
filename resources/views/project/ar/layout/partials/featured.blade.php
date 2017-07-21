  @inject('Products','App\Models\Product')
   @if(!$Products->where('is_published',1)->where('is_featured',1)->isEmpty())
      <div class="col-md-12 no-padding">
        <div class="fp">
          <div class="fp-head"><h2>featured products</h2></div>
          <div id="owl-demo" class="owl-carousel owl-theme">
          @foreach($Products->where('is_featured',1) as $product)
           <div class="item clearfix"><a href="{{url('product/'.$product->slug)}}"><img src="{{$product->imageUrl()}}"><h4>{{$product->name}}</h4><h6><div class="line-through">{{$product->price}} {{$product->currency}}</div></h6><h6>{{$product->discountedPrice()}} {{$product->currency}}</h6></a></div>
           @endforeach
                {{-- <div class="item clearfix"><a href="#"><img src="{{url('project/images/cate3.png')}}"><h4>hero GLoves </h4><h5>BLACK</h5><h6><div class="line-through">70 qar</div></h6><h6>50 qar</h6></a></div>
                <div class="item clearfix"><a href="#"><img src="{{url('project/images/cate4.png')}}"><h4>Creatine powder </h4><h5>BLACK</h5><h6></h6><h6>50 qar</h6></a></div>
                <div class="item clearfix"><a href="#"><img src="{{url('project/images/cate2.png')}}"><h4>whey powder </h4><h5>BLACK</h5><h6><div class="line-through">70 qar</div></h6><h6>50 qar</h6></a></div>
                <div class="item clearfix"><a href="#"><img src="{{url('project/images/cate1.png')}}"><h4>Harbinger </h4><h5>BLACK</h5><h6></h6><h6>50 qar</h6></a></div>
                <div class="item clearfix"><a href="#"><img src="{{url('project/images/cate3.png')}}"><h4>hero GLoves </h4><h5>BLACK</h5><h6><div class="line-through">70 qar</div></h6><h6>50 qar</h6></a></div>
                <div class="item clearfix"><a href="#"><img src="{{url('project/images/cate2.png')}}"><h4>whey powder </h4><h5>BLACK</h5><h6><div class="line-through">70 qar</div></h6><h6>50 qar</h6></a></div> --}}
            </div>
        </div>
      </div>
    @endif
    