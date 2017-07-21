@extends('admin.layout.master')

@section('active_menu','mnu-news')
@section('active_submenu','add')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
		<div class="header bg-project">
			<h2 class="">Add News</h2>
		</div>
			<div class="body">

				<form id="form_validation" method="POST" action="{{url('admin/news')}}" enctype="multipart/form-data">
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
							<label>Title</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" value="{{old('title')}}" name="title" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<label>Title Arabic</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" value="{{old('title_ar')}}" name="title_ar" class="form-control">
								</div>
							</div>
						</div>

					

						<div class="col-md-12 col-sm-12">
							<label>Content</label>
							<div class="form-group">
								<div class="form-line">
									<textarea rows="10" name="content" class="form-control" >{{old('content')}}</textarea>
								</div>
							</div>
						</div>


						<div class="col-md-12 col-sm-12">
							<label>Content Arabic</label>
							<div class="form-group">
								<div class="form-line">
									<textarea rows="10" name="content_ar" class="form-control" >{{old('content_ar')}}</textarea>
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
									@if(null != old('image'))
									@foreach(old('image') as $imageName)
									<input type="hidden" id="image-input-{{substr($imageName,0,-4)}}" name = "image[]" value="{{$imageName}}">
									<div id="image-preview-{{substr($imageName,0,-4)}}" class="col-lg-3 col-md-4 col-sm-6 m-t-30" style="min-height:100px"><span><img class="img-responsive" src="{{url(App\Models\News::IMAGE_LOCATION)."/".$imageName}}"></span></div>
									@endforeach
									@endif
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<label>Publish News</label>
							<div class="form-group">
								@php
								$checked = " checked ";
								if(old('title')){
									if(old('is_published')!=1){
										$checked=" ";
									}
								}
								@endphp
								<input type="checkbox" name="is_published" value="1" id="is_published" class="filled-in chk-col-blue" {{$checked}}>
								<label for="is_published">Publish</label>
							</div>
						</div>



						<div class="col-sm-12">
							<div class="form-group">
								<div class="">
									<input type="submit" id="saveButton" name="save" value="Save Data" class="btn btn-lg btn-success waves-effect" >
								</div>
							</div>
						</div>
					</div>

				</form>			
			</div>
		</div>

	</div>
</div>


@include('admin.layout.partials.CropperModal')

@endsection




@section('scripts')
@parent

<link href="{{url('md/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
<script src="{{url('md/plugins/cropper/cropper.min.js')}}"></script>
<script>
	$(function() {
		whyte={};
		whyte.imageWidth = 540;
		whyte.imageHeight = 360;
		whyte.storageLocation= "{{App\Models\News::IMAGE_LOCATION}}";

		whyte.postUrl = "{{url('admin/news/image')}}";
		whyte.result = $('#result');
		whyte.image = $(".featured_image > img");
		whyte.saveButton = $("#saveButton");
		whyte.imageInput =$("#ImageInput");
		whyte.cropperModal = $('#CropperModal');
		whyte.imageSizeInfo = $('#CropSizeInfo');

		var helpinfo = 'Use images of width:<b>'+whyte.imageWidth+'px</b> and height:<b>'+whyte.imageHeight+'px</b>.';
		whyte.imageSizeInfo.html(helpinfo);

		whyte.showImage = function(data){
			whyte.output = '<div id="image-preview-'+data.no_extension_filename+'" class="col-lg-3 col-md-4 col-sm-6 m-t-30" style="min-height:100px"><span><img class="img-responsive" src="' + data.src + '"></span></div>'
    // Show
    whyte.result.html(whyte.output);

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
$.ajaxSetup({
	headers: {
		'X-CSRF-Token': Laravel.csrfToken
	}
});
</script>

@endsection