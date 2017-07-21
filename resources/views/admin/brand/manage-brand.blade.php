@extends('admin.layout.master')

@section('active_menu','mnu-brands')
@section('active_submenu','manage')

@section('styles')
@parent
 <!-- JQuery DataTable Css -->
    <link href="{{url('md/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endsection


@section('content')

<div class="row">
@if(!$brands->isEmpty())

<div class="col-sm-12">
	
	<div class="card">
		<div class="header  bg-project">
			<h2 class="">Manage Brand</h2>
		</div>
	</div>
	
	<div class="connectedSortable">
	@foreach($brands as $brand)
		<div id="sort_{{$brand->id}}" class="col-md-3 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header" >
					<h2 style="white-space: nowrap;overflow:hidden">
						<span>{{str_limit($brand->name,30)}}</span>
					</h2>

					<ul class="header-dropdown m-r--5">
					<li><a href="{{url('admin/brands/edit/'.$brand->id)}}"><i class="material-icons">edit</i></a></li>
						<li><a href="{{url('admin/brands/'.$brand->id)}}" onclick="event.preventDefault();
							document.getElementById('delete-form-{{$brand->id}}').submit();">
							<form id="delete-form-{{$brand->id}}" action="{{ url('admin/brands/'. $brand->id) }}" method="post" style="display: none;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
							</form><i class="material-icons">delete</i></a></li>
						</ul>
					</div>
					<div class="body" >
						<div  id="carousel-{{$brand->id}}"  class="carousel slide">
							<div class="carousel-inner" role="listbox">
								<div class="brand active">
									<img class="img-responsive" src="{{$brand->imageUrl()}}">
								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		@endforeach
	</div>
@else
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="body">
					No data to display.
					<a href="{{url('admin/brands/add')}}" class="btn btn-info pull-right">Add Brand</a>
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


@section('scripts')
@parent

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
	    		$.post("{{url('admin/brands/sort')}}", order);
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