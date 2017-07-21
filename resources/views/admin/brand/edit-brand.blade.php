@extends('admin.layout.master')

@section('active_menu','mnu-brands')


@section('content')

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="header  bg-project">
				<h2 class="">Edit Brand</h2>
			</div>
			<div class="body">
		<form id="form_validation" method="POST" action="{{url('admin/brands/'.$brand->id)}}" enctype="multipart/form-data">
			{{csrf_field()}}
			{{ method_field('PUT') }}

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
				<label>Name</label>
				<div class="form-group ">
					<div class="form-line">
						<input type="text" value="{{$brand->name}}" name="name" class="form-control" required="">
					</div>
				</div>
			</div>





			<div class="col-sm-12">
				<div class="form-group">
					<label>Upload Image : </label>
					<span id ="ProgressInfo"></span>
					<p id="CropSizeInfo" class="help-block"></p>
					<input id="ImageInput" type="file" accept="image/*" name="image" class="col-indigo glyphicon glyphicon-picture fa-5x">
					<div id="result" class="img-preview preview-lg row">
						@if(null != $brand->medias)
						@foreach($brand->medias as $media)
						@if(null != $media->image)
						{{-- <input type="hidden" name = "image[]" value='{{$media->image}}'> --}}
						<div id="image-preview-{{substr($media->image,0,-4)}}" class="col-lg-3 col-md-4 col-sm-6 m-t-30" style="min-height:100px">
							<span>
								{{-- <button style="position: absolute;right:15px" type="button" onclick="whyte.deleteImage('{{$media->image}}')" class="btn btn-xs  waves-effect btn-danger"><i class="material-icons">close</i></button> --}}
								<img class="img-responsive" style="width:100%" src="{{url(App\Models\Brand::IMAGE_LOCATION)."/".$media->image}}">
							</span>
						</div>
						@endif
						@endforeach
						@endif
					</div>
				</div>
			</div>

						<div class="col-sm-12">
				<label>Publish Brand</label>
				<div class="form-group">
					@php
					if($brand->is_published){
						$checked = " checked ";
					}
					@endphp
					<input type="checkbox" name="is_published" value="1" id="is_published" class="filled-in chk-col-blue" {{$checked or ""}}>
					<label for="is_published">Publish</label>
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

<!-- Bootstrap Select Css -->
<link href="{{url('md/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<!-- Select Plugin Js -->
<script src="{{url('md/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>


<link href="{{url('md/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
<script src="{{url('md/plugins/cropper/cropper.min.js')}}"></script>
<script>
  $(function() {
    whyte={};
    whyte.imageWidth = 347;
	whyte.imageHeight = 200;
    whyte.storageLocation= "{{App\Models\Brand::IMAGE_LOCATION}}";
    whyte.postUrl = "{{url('admin/brands/image')}}";

    whyte.deleteUrl = whyte.postUrl;
    whyte.result = $('#result');
    whyte.image = $(".featured_image > img");
    whyte.saveButton = $("#saveButton");
    whyte.imageInput =$("#ImageInput");
    whyte.cropperModal = $('#CropperModal');
    whyte.imageSizeInfo = $('#CropSizeInfo');

    var helpinfo = 'Use images of width:<b>'+whyte.imageWidth+'px</b> and height:<b>'+whyte.imageHeight+'px</b>.';
    whyte.imageSizeInfo.html(helpinfo);

    whyte.showImage = function(data){
    	whyte.output = '<div id="image-preview-'+data.no_extension_filename+'" class="col-lg-3 col-md-4 col-sm-6 m-t-30" style="min-height:100px"><span><img class="img-responsive" style="width:100%" src="' + data.src + '"></span></div>'
    // Show
    whyte.result.html(whyte.output);

    var imageNameElement = $('<input>').attr('type','hidden')
    .attr('id','image-input-'+data.no_extension_filename)
    .attr('name','image[]')
    .attr('value',data.filename);
    whyte.result.append(imageNameElement);
}

// whyte.deleteImage = function(filename){
// 	if(!confirm('Are you sure want to delete the image?')) return false;
// 	$.ajax({
// 		url: whyte.deleteUrl,
// 		type: 'DELETE',
// 		data:{
// 			filename:filename
// 		},
// 		success: function(){
// 			$('#image-preview-'+filename.slice(0,-4)).remove();
// 			$('#image-input-'+filename.slice(0,-4)).remove();
// 		},
// 		error: function(){
// 			alert('failed');
// 		}
// 	});
// }

});
</script>
<script src="{{url('md/js/whyte-cropper.js')}}"></script>


<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-Token': Laravel.csrfToken
	}
});
</script>

@endsection