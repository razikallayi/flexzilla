@extends('admin.layout.master')

@section('active_menu','mnu-terms')
@section('active_submenu','manage')

@section('styles')
@parent
 <!-- JQuery DataTable Css -->
    <link href="{{url('md/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endsection


@section('content')

<div class="row">
@if(!$terms->isEmpty())
<div class="col-sm-12">
	<div class="card">
		<div class="header bg-project">
			<h2 class="">Manage Terms</h2>
		</div>

		<div class="body table-wrapper">
			@if (session()->has('message'))
			<div class="alert {{session()->get('status')}}">
				<ul>
					<li>{!!session()->get('message')!!}</li>
				</ul>
			</div>
			@endif
			<table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable"  data-page-length="50">
				<thead>
					<tr>
						<th width="10px">Sl.No</th>
						<th>Title</th>
						<th>Content</th>
						<th width="10px">Edit</th>
						<th width="10px">Delete</th>
					</tr>
				</thead>
				<tbody>
					
					
					@foreach($terms as $term)
					
					
					<tr>
						<td>{{$term->serial_number}}</td>
						<td>{{$term->title}}</td>
						<td>{{$term->content}}</td>
						<td><a href="{{url('admin/terms/edit/'.$term->id)}}"><i class="material-icons">edit</i></a></td>
						<td width="5px"><a href="{{url('admin/terms/'.$term->id)}}" onclick="if(!confirm('Are you sure want to delete?')) return false;event.preventDefault();
                                                 document.getElementById('delete-form-{{$term->id}}').submit();">
                                                 <form id="delete-form-{{$term->id}}" action="{{ url('admin/terms/'. $term->id) }}" method="post" style="display: none;">
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
@else
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="body">
					No data to display.
					<a href="{{url('admin/terms/add')}}" class="btn btn-info pull-right">Add Terms</a>
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

@endsection