@extends('admin.layout.master')

@section('active_menu','mnu-product')
@if(!isset($product))
@section('active_submenu', 'add')
@endif


@section('content')

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="header bg-project">
				<h2 class="">@if(isset($product)) Edit @else Add @endif Product</h2>
			</div>
			<div class="body">
			@if(isset($product))
				<form id="form_validation" method="POST" action="{{url('admin/products/edit/'.$product->id)}}" enctype="multipart/form-data">
					{{ method_field('PUT') }}
			@else
			<form id="form_validation" method="POST" action="{{url('admin/products')}}" enctype="multipart/form-data">
			@endif
			{{csrf_field()}}

					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					@if (session()->has('message'))
					<div class="alert {{session()->get('status')}}">
						<ul>
							<li>{!!session()->get('message')!!}</li>
						</ul>
					</div>
					@endif


					<div class="row clearfix">

						<div class="col-md-12 col-sm-12">
							<label>Category<code>*</code></label>
							<div class="form-group">
								<select name="product_category_id" required class="form-control show-tick" tabindex="-98">
									<option value="">-- Please select --</option>
									@php
									if(isset($product)){
										$selectedId = $product->product_category_id;
									}
									else{
										$selectedId = old('product_category_id');
									}
									@endphp
									@inject('ProductCategory', 'App\Models\ProductCategory')
									@foreach($ProductCategory->all() as $productCategory)
									<option value="{{$productCategory->id}}" @if(isset($selectedId)&& $selectedId== $productCategory->id) selected @endif>{{$productCategory->name}}</option>
									@endforeach
								</select>
							</div>
						</div>


		<div class="col-md-6 col-sm-12">
			<label>Name<code>*</code></label>
			<div class="form-group ">
				<div class="form-line">
					<input type="text" value="{{$product->name or old('name')}}" name="name" maxlength="191" class="form-control" required="">
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<label>Name Arabic</label>
			<div class="form-group ">
				<div class="form-line">
					<input type="text" value="{{$product->name_ar or old('name_ar')}}" name="name_ar" class="arabic_input form-control">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-12">
			<label>Price</label>
			<div class="form-group">
				<div class="form-line">
					<input type="number" value="{{$product->price or old('price')}}" name="price" min="0" class="form-control">
				</div>
			</div>
		</div>

		

		<div class="col-md-4 col-sm-12">
		<label>Currency</label>
			<div class="form-group">
				<div class="form-line">
					<input type="hidden" value="QAR">
					<select name="currency" disabled="" class="form-control show-tick" tabindex="-98">
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-12">
			<label>Discounted Amount</label>
			<div class="form-group">
				<div class="form-line">
					<input type="number" value="{{$product->discount or old('discount')}}" name="discount" min="0" class="form-control">
				</div>
			</div>
		</div>

			{{-- 	<div class="col-md-12 col-sm-12">
			<label>Add Attribute</label>
			<div class="form-group ">
				<input type="button" id="addAttribute" value="Add" class="btn btn-success waves-effect" >
			</div>
		</div> --}}


		<div class="col-md-6 col-sm-12">
			<label>Brief Description</label>
			<div class="form-group">
				<div class="form-line">
					<textarea rows="2" name="brief" class="form-control" >{{$product->brief or old('brief')}}</textarea>
				</div>
			</div>
		</div>


		<div class="col-md-6 col-sm-12">
			<label>Brief Description Arabic</label>
			<div class="form-group">
				<div class="form-line">
					<textarea rows="2" name="brief_ar" class="form-control arabic_input" >{{$product->brief_ar or old('brief_ar')}}</textarea>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<label>Specifications</label>
			<div class="form-group">
				<div class="form-line">
					<textarea rows="10" name="specifications" class="form-control" >{{$product->specifications or old('specifications')}}</textarea>
				</div>
			</div>
		</div>


		<div class="col-md-6 col-sm-12">
			<label>Specifications Arabic</label>
			<div class="form-group">
				<div class="form-line">
					<textarea rows="10" name="specifications_ar" class="arabic_input form-control" >{{$product->specifications_ar or old('specifications_ar')}}</textarea>
				</div>
			</div>
		</div>



		<div class="col-md-6 col-sm-12">
			<label>Description</label>
			<div class="form-group">
				<div class="form-line">
					<textarea rows="10" name="description" class="form-control" >{{$product->description or old('description')}}</textarea>
				</div>
			</div>
		</div>


		<div class="col-md-6 col-sm-12">
			<label>Description Arabic</label>
			<div class="form-group">
				<div class="form-line">
					<textarea rows="10" name="description_ar" class="form-control" >{{$product->description_ar or old('description_ar')}}</textarea>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="form-group">
				<label>Upload Images<code>*</code> </label>
				<span id ="ProgressInfo"></span>
				<p id="CropSizeInfo" class="help-block"></p>
				<input id="ImageInput" accept="image/*" class="col-indigo glyphicon glyphicon-picture fa-5x" name="image[]" type="file" />
				<br/>
				<b>Preview</b><br/>
			</div>
			

			<div id="result" class="connectedSortable">
				@if(isset($product) && null != $product->medias)
				@foreach($product->medias as $media)

				@if(null != $media->image)

				<div id="image-preview-{{substr($media->image,0,-4)}}" class="col-lg-3 col-md-4 col-sm-6 m-t-30 sort_handle" style="min-height:100px">
					<span>
						<button type="button" style="float:right;" onclick="deleteImage('{{$media->image}}')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button>
						
						<img class="img-responsive sortable_image" style="width:100%" src="{{url(App\Models\Product::IMAGE_LOCATION)."/".$media->image}}">
					</span>
				</div>
				@endif
				@endforeach
				@endif
			</div>


		</div>


		<div class="col-md-4 col-sm-12">
			<label>Publish Product</label>
			<div class="form-group">
				@php
				$checked="";
				if(isset($product) && $product->is_published){
					$checked = " checked ";
				}
				else{
					$checked = old('is_published')==1?"checked":"";
				}
				@endphp
				<input type="checkbox" name="is_published" value="1" id="is_published" class="filled-in chk-col-blue" {{$checked or ""}}>
				<label for="is_published">Publish</label>
			</div>
		</div>


		<div class="col-md-4 col-sm-12">
			<label>Best Selling</label>
			<div class="form-group">
				@php
				$checked="";
				if(isset($product) && $product->is_best_selling){
					$checked = " checked ";
				}
				else{
					$checked = old('is_best_selling')==1?"checked":"";
				}
				@endphp
				<input type="checkbox" name="is_best_selling" value="1" id="is_best_selling" class="filled-in chk-col-blue" {{$checked or ""}}>
				<label for="is_best_selling">Best Selling</label>
			</div>
		</div>


		<div class="col-md-4 col-sm-12">
			<label>Is Featured Product</label>
			<div class="form-group">
				@php
				$checked="";
				if(isset($product) && $product->is_featured){
					$checked = " checked ";
				}
				else{
					$checked = old('is_featured')==1?"checked":"";
				}
				@endphp
				<input type="checkbox" name="is_featured" value="1" id="is_featured" class="filled-in chk-col-blue" {{$checked or ""}}>
				<label for="is_featured">Featured Product</label>
			</div>
		</div>


		<div class="col-sm-12">
			<div class="form-group">
				<div class="">
					<input type="submit" id="saveButton" name="save" value="Save Data" class="btn btn-success waves-effect" >
				</div>
			</div>
		</div>

	</div>
</form>			
</div>
</div>

</div>

@include('admin.layout.partials.CropperModal')

@endsection



@section('scripts')
@parent

<script type="text/javascript">
	var deleteImage = function(filename){
		if(!confirm('Are you sure to delete?')){
			return;
		}
		$.ajax({
			url: "{{ url('admin/products/image')}}",
			type: 'DELETE',
			data:{location:"{{App\Models\Product::IMAGE_LOCATION}}",
			filename:filename
		},
		success: function(){
			$('#image-input-'+filename.slice(0,-4)).remove();
			$('#image-preview-'+filename.slice(0,-4)).remove();
		},
		error: function(){
			alert('failed');
		}
	});
	}
</script>


<!-- Bootstrap Select Css -->
<link href="{{url('md/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<!-- Select Plugin Js -->
<script src="{{url('md/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

 <link href="{{url('md/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
<script src="{{url('md/plugins/cropper/cropper.min.js')}}"></script>
<script>
  $(function() {
    whyte={};
    whyte.imageWidth = 400;
    whyte.imageHeight = 407;
    whyte.storageLocation= "{{App\Models\Product::IMAGE_LOCATION}}";
    whyte.postUrl = "{{url('admin/products/image')}}";

    whyte.deleteUrl = whyte.postUrl;
    whyte.hasThumbChooser = false;
    whyte.hasDeleteButton = true;
    whyte.result = $('#result');
    whyte.image = $(".featured_image > img");
    whyte.saveButton = $("#saveButton");
    whyte.imageInput =$("#ImageInput");
    whyte.cropperModal = $('#CropperModal');
    whyte.imageSizeInfo = $('#CropSizeInfo');

    var helpinfo = 'Use images of width:<b>'+whyte.imageWidth+'px</b> and height:<b>'+whyte.imageHeight+'px</b>.';
    whyte.imageSizeInfo.html(helpinfo);

    whyte.showImage = function(data){
    	var setThumb='';
    	var deleteButton = '';
    	if(whyte.hasThumbChooser){
    		setThumb = '<input name="is_thumbnail" type="radio" id="radio-'+data.filename+'" value="'+data.filename+'" class="radio-col-blue" checked><label for="radio-'+data.filename+'">Set as Thumbnail</label>';
    	}
    	if(whyte.hasDeleteButton){
    		deleteButton = '<button style="position: absolute;right:15px" type="button" onclick="whyte.deleteImage(\''+data.filename+'\')" class="btn btn-xs  waves-effect btn-danger"><i class="material-icons">close</i></button>';
    	}
    	whyte.output = '<div id="image-preview-'+data.no_extension_filename+'" class="col-lg-3 col-md-4 col-sm-6 m-t-30" style="min-height:100px"><span>'
    		+setThumb
			+deleteButton
			+'<img class="img-responsive" style="width:100%" src="' + data.src + '"></span></div>'
    // Show
    whyte.result.append(whyte.output);

    var imageNameElement = $('<input>').attr('type','hidden')
    .attr('id','image-input-'+data.no_extension_filename)
    .attr('name','image[]')
    .attr('value',data.filename);
    whyte.result.append(imageNameElement);
}
});
</script>
<script src="{{url('md/js/whyte-cropper.js')}}"></script>


<script type="text/javascript">
	$(function() {
	  var currencies = @include('admin.layout.partials.currency');
	  var currencyDropdown = $('select[name="currency"]');
	  var options="<option value=''>-- Please select --</option>";
	  var isSelected=" ";
	  var oldCurrency;
	  @if(isset($product) && $product->currency != null)
	  	oldCurrency = "{{$product->currency}}";
	  @endif
	  $.each(currencies.currency,function(i,currency){
	  	if(oldCurrency == currency.short){
	  		isSelected=" selected ";
	  	}else{
	  	   isSelected="";
                   if(currency.short == "QAR"){isSelected=" selected "};
	  	}
	  	options += '<option value='+currency.short+ isSelected+ '>'+currency.short+'</option>';
	  });
	
	  currencyDropdown.html(options);
	  currencyDropdown.selectpicker('refresh');
	});
</script>



<script>
	`<div class="col-md-6 col-sm-12">
			<label>Atribute Name</label>
			<div class="form-group ">
				<div class="form-line">
					<input type="text" value="{{$product->name or old('name')}}" name="attribute_name[0]" placeholder="eg: Color" maxlength="191" class="form-control" required="">
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-12">
			<label>Attribute Value</label>
			<div class="form-group ">
				<div class="form-line">
					<input type="text" value="{{$product->name_ar or old('name_ar')}}" name="attribute_value[0]" placeholder="eg: Black" class="form-control">
				</div>
			</div>
		</div>`

</script>




	<!-- jquery sortable Plugin Css -->
{{-- 	<link href="{{url('md/plugins/jquery-sortable/jquery-sortable.min.css')}}" rel="stylesheet">
	<!-- Jquery sortable Plugin Js -->
	<script src="{{url('md/plugins/jquery-sortable/jquery-sortable.min.js')}}"></script>
	<script type="text/javascript">
    	$(".connectedSortable").sortable({
    		connectWith: ".connectedSortable",
    		revert: 200,
    		handle: ".sortable_image",
    		zIndex: 999999
    	});
    	$(".connectedSortable .sortable_image").css("cursor", "move");
    	$(".connectedSortable").on( "sortupdate", function( event, ui,i ) {
    		var order = $(this).sortable("serialize",{key:'sort[]'})+ '&productId={{$product->id}}';;
    		$.post("{{url('admin/products/image/sort')}}", order);
    	});
    </script> --}}

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

@endsection