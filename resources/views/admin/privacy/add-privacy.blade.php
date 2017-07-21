@extends('admin.layout.master')

@section('active_menu','mnu-privacy')
@section('active_submenu','add')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
		<div class="header bg-project">
			<h2 class="">Add Privacy</h2>
		</div>
			<div class="body">

				<form id="form_validation" method="POST" action="{{url('admin/privacy')}}" enctype="multipart/form-data">
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
							<label>Serial Number</label>
							<div class="form-group ">
								<div class="form-line">
								@php
								if(old('serial_number')){
									$count = old('serial_number');
								}
								else{
									$count = App\Models\Privacy::max('serial_number')+1;
									$count = $count==null? 1: $count;
								}
								@endphp
									<input type="number" min="1" value="{{$count}}" name="serial_number" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<label>Title</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" value="{{old('title')}}" name="title" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<label>Title Arabic</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" value="{{old('title_ar')}}" name="title_ar" class="arabic_input form-control">
								</div>
							</div>
						</div>

					

						<div class="col-md-6 col-sm-12">
							<label>Content</label>
							<div class="form-group">
								<div class="form-line">
									<textarea rows="10" name="content" class="form-control" >{{old('content')}}</textarea>
								</div>
							</div>
						</div>


						<div class="col-md-6 col-sm-12">
							<label>Content Arabic</label>
							<div class="form-group">
								<div class="form-line">
									<textarea rows="10" name="content_ar" class="arabic_input form-control" >{{old('content_ar')}}</textarea>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<label>Publish Privacy</label>
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



@endsection