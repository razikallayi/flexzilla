@extends('admin.layout.master')

@section('active_menu','mnu-product')
@section('active_submenu','manage-productCategory')

@section('styles')
@parent

 <!-- JQuery DataTable Css -->
    <link href="{{url('md/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endsection


@section('content')

<div class="row">

	<div class="col-md-12">

		@if (session()->has('message'))
		<div class="alert {{session()->get('status')}}">
			<ul>
				<li>{!!session()->get('message')!!}</li>
			</ul>
		</div>
		@endif

		<div class="card">
			<div class="header bg-project">
				@if(isset($categoty) && $categoty !=null)
				<h2> Edit Product Category <a class="pull-right" href="{{url('admin/products/categories')}}"><i class="material-icons col-white">add</i></a></h2>
				@else
				<h2>Add Product Category</h2>
				@endif
			</div>
			<div class="body">

				@if(isset($categoty) && $categoty !=null)
					<form id="form_validation" action="{{url('admin/products/category/edit/'.$categoty->id)}}" method="POST">
					{{ method_field('PUT') }}
				@else 
					<form id="form_validation" action="{{url('admin/products/categories')}}" method="POST">
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

					<div class="row clearfix">
						<div class="col-sm-6">
							<label>Name</label>
							<div class="form-group ">
								<div class="form-line">
									@if(isset($categoty) && $categoty !=null)
									<input type="text" value="{{$categoty->name}}" name="name" maxlength="191" class="form-control" required="" style="background:#FC0">
									@else
									<input type="text"   value="{{old('name')}}" name="name" maxlength="191" class="form-control" required="">
									@endif
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<label>Name Arabic</label>
							<div class="form-group ">
								<div class="form-line">
									@if(isset($categoty) && $categoty !=null)
									<input type="text" value="{{$categoty->name_ar}}" name="name_ar" maxlength="191" class="form-control arabic_input" style="background:#FC0">
									@else
									<input type="text"   value="{{old('name_ar')}}" name="name_ar" maxlength="191" class="form-control arabic_input">
									@endif
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group">
								<label>Upload Images<code>*</code> </label>
								<span id ="ProgressInfo"></span>
								<p id="CropSizeInfo" class="help-block"></p>
								<input id="ImageInput" accept="image/*" class="col-indigo glyphicon glyphicon-picture fa-5x" type="file" />
								<br/>
								<b>Preview</b><br/>
							</div>
							

							<div id="result" class="connectedSortable">
								@php
								if(isset($categoty) && $categoty !=null){
									$image = $categoty->image;
								}
								else{
									$image = old('image');
								}
								@endphp
								@if($image!=null)
								<input type="hidden" name = "image" value='{{$image}}'>
								<div id="image-preview-{{substr($image,0,-4)}}" class="col-lg-3 col-md-4 col-sm-6 m-t-30 sort_handle" style="min-height:100px">
									<span>
									{{-- 	<button type="button" style="float:right;" onclick="deleteImage('{{$image}}')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button> --}}
										
										<img class="img-responsive sortable_image" style="width:100%" src="{{url(App\Models\ProductCategory::IMAGE_LOCATION)."/".$image}}">
									</span>
								</div>
								@endif
							</div>


						</div>


						<div class="col-sm-12">
							<div class="form-group">
								<div class="">
									<input type="submit" id="saveButton" name="save" value="Save Data" class="btn btn-lg btn-success waves-effect" >
									@if(isset($categoty) && $categoty !=null)
									<a href="{{url('admin/products/categories')}}" class="btn btn-lg btn-default waves-effect pull-right">Close Edit</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</form>			
			</div>
		</div>
	</div>


	@if(!$productCategories->isEmpty())

{{-- 
	<div class="col-md-6">
		<div class="card">
			<div class="header bg-project">
				<h2 class="">Manage Product Categorys</h2>
			</div>

			<div class="body table-wrapper">
				<table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable" data-page-length="50">
					<thead>
						<tr>
							<th>Sl.No</th>
							<th>Name</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>


						@foreach($productCategories as $productCategory)

						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$productCategory->name}}</td>
							<td width="5px"><a href="{{url('admin/products/category/'.$productCategory->id)}}" onclick="if(!confirm('Are you sure want to delete?')) return false;event.preventDefault();
								document.getElementById('delete-form-{{$productCategory->id}}').submit();">
								<form id="delete-form-{{$productCategory->id}}" action="{{ url('admin/products/category/'. $productCategory->id) }}" method="post" style="display: none;">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
								</form><i class="material-icons">delete</i></a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
 --}}





<div class="col-sm-12">
	
	<div class="card">
		<div class="header bg-project">
			<h2 class="">Manage Property Categories</h2>
		</div>
	</div>
	
	<div class="connectedSortable row">
	@foreach($productCategories as $productCategory)
		<div id="sort_{{$productCategory->id}}" class="col-md-3 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header" >
					<h2 style="white-space: nowrap;overflow:hidden">
						<span>{{$productCategory->name}}</span>
					</h2>

					<ul class="header-dropdown m-r--5">
					<li><a href="{{url('admin/products/category/edit/'.$productCategory->id)}}"><i class="material-icons">edit</i></a></li>
						<li><a href="{{url('admin/products/category/'.$productCategory->id)}}" onclick="event.preventDefault();
							document.getElementById('delete-sort-form-{{$productCategory->id}}').submit();">
							<form id="delete-sort-form-{{$productCategory->id}}" action="{{ url('admin/products/category/'. $productCategory->id) }}" method="post" style="display: none;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
							</form><i class="material-icons">delete</i></a></li>
						</ul>
					</div>
					<div class="body" >
						<div  id="carousel-{{$productCategory->id}}"  class="carousel slide">
							<div class="carousel-inner" role="listbox">
								<div class="product active">
									<img class="img-responsive" src="{{$productCategory->imageUrl()}}">
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		@endforeach
	</div>



		@endif
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
			data:{location:"{{App\Models\ProductCategory::IMAGE_LOCATION}}",
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
    whyte.imageWidth = 244;
    whyte.imageHeight = 248;
    whyte.postUrl = "{{url('admin/products/category/image')}}";

    whyte.deleteUrl = whyte.postUrl;
    whyte.hasThumbChooser = false;
    whyte.hasDeleteButton = false;
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
    whyte.result.html(whyte.output);

    var imageNameElement = $('<input>').attr('type','hidden')
    .attr('id','image-input-'+data.no_extension_filename)
    .attr('name','image')
    .attr('value',data.filename);
    whyte.result.append(imageNameElement);
}
});
</script>
<script src="{{url('md/js/whyte-cropper.js')}}"></script>



	    <!-- Jquery DataTable Plugin Js -->
    <script src="{{url('md/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{url('md/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

    <script>
    	$(function () {
    		$('.js-basic-example').DataTable();
    	});
    </script>


    <!-- jquery sortable Plugin Css -->
    <link href="{{url('md/plugins/jquery-sortable/jquery-sortable.min.css')}}" rel="stylesheet">
    <!-- Jquery sortable Plugin Js -->
    <script src="{{url('md/plugins/jquery-sortable/jquery-sortable.min.js')}}"></script>
    <script type="text/javascript">
    	$(".connectedSortable").sortable({
    		connectWith: ".connectedSortable",
    		revert: 200,
    		handle: ".card",
    		zIndex: 999999
    	});
    	$(".connectedSortable .card").css("cursor", "move");
    	$(".connectedSortable").on( "sortupdate", function( event, ui ) {
    		var order = $(this).sortable("serialize");
    		$.post("{{url('admin/products/categories/sort')}}", order);
    	});
    </script>


    <script type="text/javascript">
    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    		}
    	});
    </script>

@endsection