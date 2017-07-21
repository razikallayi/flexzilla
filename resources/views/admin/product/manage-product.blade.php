@extends('admin.layout.master')

@section('active_menu','mnu-product')
@section('active_submenu', 'manage')

@section('styles')
@parent
 <!-- JQuery DataTable Css -->
    <link href="{{url('md/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endsection


@section('content')

<div class="row">
@if(!$products->isEmpty())

<div class="col-sm-12 mode" id="ListMode">
	<div class="card">
		<div class="header bg-project">
			<h2 class="">Manage Product<a href="{{url('admin/products')}}"><i class="material-icons pull-right">view_module</i></a></h2>
		</div>

		<div class="body table-wrapper">
			@if (session()->has('message'))
			<div class="alert {{session()->get('status')}}">
				<ul>
					<li>{!!session()->get('message')!!}</li>
				</ul>
			</div>
			@endif
{{-- 
			<input type="checkbox" name="featured" id="featured" onchecked="" class="filled-in chk-col-deep-purple" >
			<label for="featured">Featured Product</label> --}}

			<table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable"  data-page-length="50">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Image</th>
						<th>Name</th>
						<th>Category</th>
						<th>Brief</th>
						<th>Price</th>
						<th >Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					
					
					@foreach($products as $product)
					
					{{-- {{dd(App\Models\Product::IMAGE_LOCATION.'/'.$product->getThumbnail()->image)}} --}}
					
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>
						@if($product->medias->first() != null)
						<img height="50px" src="{{url(App\Models\Product::IMAGE_LOCATION.'/'.$product->medias->first()->image)}}">
						@endif
						</td>
						<td>{{$product->name}}</td>
						<td>{{@$product->category->name}}</td>
						<td>{{$product->brief}}</td>
						<td>{{number_format($product->price)}} {{$product->currency}}</td>
						<td><a href="{{url('admin/products/edit/'.$product->id)}}"><i class="material-icons">edit</i></a></td>
						<td width="5px"><a href="{{url('admin/products/'.$product->id)}}" onclick="if(!confirm('Are you sure want to delete?')) return false;event.preventDefault();
                                                 document.getElementById('delete-form-{{$product->id}}').submit();">
                                                 <form id="delete-form-{{$product->id}}" action="{{ url('admin/products/'. $product->id) }}" method="post" style="display: none;">
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

{{-- 
<div class="col-sm-12 mode" id="SortMode" style="display:none">
<div class="card">
	<div class="header bg-project">
		<h2 class="">Manage Product<a href="javascript:void(0);" onClick="viewMode('ListMode')" title="List view"><i class="material-icons pull-right">view_module</i></a></h2>
	</div>
	</div>
		@foreach($products->chunk(4) as $chunk)
		<div class="col-md-12 connectedSortable">
		@foreach($chunk as $product)
			<div id="sort_{{$product->id}}" class="col-md-3 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header" >
						<h2 style="white-space: nowrap;overflow:hidden">
							<span>@if($product->reference_id){{$product->reference_id}}@else {{'0'}}@endif</span>
							<small><b>{{$product->title}}</b></small>
							<small>{{$product->getAddress()}}</small>
							<small>{{number_format($product->price)}} {{$product->currency}}</small>
						</h2>

						<ul class="header-dropdown m-r--5">
						<li><a href="{{url('admin/products/edit/'.$product->id)}}"><i class="material-icons">edit</i></a></li>
							<li><a href="{{url('admin/products/'.$product->id)}}" onclick="event.preventDefault();
								document.getElementById('delete-form-{{$product->id}}').submit();">
								<form id="delete-form-{{$product->id}}" action="{{ url('admin/products/'. $product->id) }}" method="post" style="display: none;">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
								</form><i class="material-icons">delete</i></a></li>
							</ul>
						</div>
						<div class="body">
							<div  id="carousel-{{$product->id}}"  class="carousel slide">
								<div class="carousel-inner" role="listbox">
									<div class="product active">
										@if($product->getThumbnail() != null)
										<img class="img-responsive" src="{{url(App\Models\Product::IMAGE_LOCATION.'/'.$product->getThumbnail()->image)}}">
										@endif
									</div>

								</div>

							</div>
						</div>

					</div>
				</div>
			@endforeach
			</div>
			@endforeach
		</div> --}}

@else
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="body">
					No data to display.
					<a href="{{url('admin/products/add')}}" class="btn btn-info pull-right">Add Product</a>
				</div>
			</div>
		</div>
		@endif
	</div>

@endsection


	@section('scripts')
	@parent

	    <!-- Jquery DataTable Plugin Js -->
    <script src="{{url('md/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{url('md/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
	$(function () {
		$('.js-basic-example').DataTable();
	});
</script>

{{-- 
<script>
	viewMode= function(mode){
		$('.mode').slideUp(500);
		$('#'+mode).slideDown(500);
	}
</script>
 --}}

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
    		var order = $(this).sortable("serialize") + '&action=updateCategoryListings';
    		$.post("{{url('admin/products/sort')}}", order);
    	});
    </script>

    <script type="text/javascript">
    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-Token': Laravel.csrfToken
    		}
    	});
    </script>


@endsection