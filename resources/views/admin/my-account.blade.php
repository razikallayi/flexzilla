@extends('admin.layout.master')

@section('title', 'My Account')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="body">
				<form id="form_validation" method="POST" action="{{url('/admin/my-account/')}}" enctype="multipart/form-data"> 
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

					<div class=" clearfix">
						<div class="col-sm-12">
							<h2 class="card-inside-title">Name</h2>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" name="name" maxlength="255" value="{{$user->name}}" class="form-control" required>
								</div>
							</div>
						</div>
					</div>

					<div class=" clearfix">
						<div class="col-sm-12">
							<h2 class="card-inside-title">Username</h2>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" name="username" maxlength="255" value="{{$user->username}}" class="form-control" required>
								</div>
							</div>
						</div>
					</div>

					<div class=" clearfix">
						<div class="col-sm-12">
							<h2 class="card-inside-title">Email</h2>
							<p class="help-block small">This email will be used to send forgot password link</p>
							<div class="form-group ">
								<div class="form-line">
									<input type="email" name="email" maxlength="255" value="{{$user->email}}" class="form-control" required>
								</div>
							</div>
						</div>
					</div>

					<div class=" clearfix">
						<div class="col-sm-12">
							<h2 class="card-inside-title">Current Password</h2>
							<div class="form-group ">
								<div class="form-line">
									<input type="password" name="current_password" maxlength="255" class="form-control" required>
								</div>
							</div>
						</div>
					</div>

					<div class=" clearfix">
						<div class="col-sm-12">
							<h2 class="card-inside-title">New Password</h2>
							<p class="help-block small">Type a strong password containing <strong>atleast 6 characters</strong>, capital letters, small letters, numbers and special characters for the security of your application</p>
							<div class="form-group ">
								<div class="form-line">
									<input type="password" name="new_password" maxlength="255"  autocomplete="off" class="form-control" required>
								</div>
							</div>
						</div>
					</div>

					<div class=" clearfix">
						<div class="col-sm-12">
							<h2 class="card-inside-title">Confirm Password</h2>
							<div class="form-group ">
								<div class="form-line">
									<input type="password" name="new_password_confirmation"  autocomplete="off" maxlength="255"  class="form-control" required>
								</div>
							</div>
						</div>
					</div>


					<div class="clearfix">
						<div class="col-sm-12">
							<div class="form-group">
								<div class="">
								<input type="submit" id="saveButton" name="save" value="Update" class="btn btn-success waves-effect" >
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

@section('scripts')
@parent

<script type="text/javascript">
//Activate current item in left side menu
$(document).ready(function() {
	$(".menu .list li").removeClass('active');
	$("#mnu-dashboard").addClass('active').find('a').click();
});
</script>

@endsection