@extends('admin.layout.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">



	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header bg-project">
				<h2 style="color:#FFF">Product</h2>
			</div>
			<div class="body">
				<div class="list-group">
					<br/>
					<a href="{{url('admin/products/categories')}}" class="list-group-item">Category</a>
					<a href="{{url('admin/products/add')}}" class="list-group-item">Add Property</a>
					<a href="{{url('admin/products')}}" class="list-group-item">Manage Properties</a>
				</div>
			</div>
		</div>
	</div>






	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header bg-project">
				<h2 style="color:#FFF">Brands</h2>
			</div>
			<div class="body">
				<div class="list-group">
					<br/><br/>
					<a href="{{url('admin/brands/add')}}" class="list-group-item">Add</a>
					<a href="{{url('admin/brands')}}" class="list-group-item">Manage</a>
					<br/><br/>
				</div>
			</div>
		</div>
	</div>



	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header bg-project">
				<h2 style="color:#FFF">News</h2>
			</div>
			<div class="body">
				<div class="list-group">
					<br/><br/>
					<a href="{{url('admin/news/add')}}" class="list-group-item">Add</a>
					<a href="{{url('admin/news')}}" class="list-group-item">Manage</a>
					<br/><br/>
				</div>
			</div>
		</div>
	</div>



	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header bg-project">
				<h2 style="color:#FFF">Terms and Conditions</h2>
			</div>
			<div class="body">
				<div class="list-group">
					<a href="{{url('admin/terms/add')}}" class="list-group-item">Add</a>
					<a href="{{url('admin/terms')}}" class="list-group-item">Manage</a>
					<br/><br/>
				</div>
			</div>
		</div>
	</div>



	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="card">
			<div class="header bg-project">
				<h2 style="color:#FFF">Privacy Policy</h2>
			</div>
			<div class="body">
				<div class="list-group">
					<a href="{{url('admin/privacy/add')}}" class="list-group-item">Add</a>
					<a href="{{url('admin/privacy')}}" class="list-group-item">Manage</a>
					<br/><br/>
				</div>
			</div>
		</div>
	</div>




</div>
@endsection