<!DOCTYPE html>
<html>
<head></head>
<body style=" color:  {{config('whyte.project.secondary-color')}}"">
<table width="600px" border="0">
		<thead>
		<tr><th colspan="2"><img style="height:70px;" src="{{url(config('whyte.project.logo'))}}"><h3>Order from {{config('whyte.project.name')}} Website</h3></th></tr>
		</thead>
		<tbody>
			<tr><td>Name</td><td>{{$request->name}}</td></tr>
			<tr><td>Email</td><td>{{$request->email}}</td></tr>
			<tr><td>Phone</td><td>{{$request->phone}}</td></tr>
			<tr><td>Address</td><td>{{$request->address}}</td></tr>
			<tr><td colspan='2'>
				<table width='600px' class='table' border='0'>
				      <thead style='background:{{config('whyte.project.theme-color')}};color:{{config('whyte.project.theme-font-color')}}'>
				        <tr>
				          <th>Image</th>
				          <th>Item</th>
				          <th>Unit Price</th>
				          <th>Quantity</th>
				          {{-- <th>Comments</th> --}}
				          <th>Total</th>
				        </tr>
				      </thead>
				      <tbody>
				       @foreach(Cart::getContent() as $item)
				        <tr style='text-align:center; border-bottom: #222 solid; '>
			 	          <td><img style='width:50px;' src='{{$item->attributes->image}}'></td>
			 	          <td>{{$item->name}}</td>
				          <td>QAR {{$item->price}}</td>
				          <td>{{$item->quantity}}</td>
				          {{-- <td>{{$item->attributes->comments}}</td> --}}
				          <td>QAR {{$item->price * $item->quantity}}</td>
				        </tr>
				       @endforeach
		       	        <tr style='background:{{config('whyte.project.secondary-color')}};color:#FFF;text-align:right;'>
		        	      <td  colspan='3' style=' padding:0.8em;'>TOTAL</td>
		        	      <td  colspan='3'  style=' padding:0.8em;'>{{Cart::getTotal()}}</td>
		       	        </tr>
				      </tbody>
				    </table>
			</td></tr>
		</tbody>
	</table>
</body>
</html>