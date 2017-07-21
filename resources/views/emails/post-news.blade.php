<!DOCTYPE html>
<html>
<head></head>
<body style='background: white; color: #222'>
<table width='600px' border='0'>
		<thead>
		<tr><th colspan='2'><img style='height:50px;' src='{{url(config('whyte.project.logo'))}}'><h2>{{$news->title}}</h2></th></tr>
		</thead>
		<tbody>
			<tr><td>{{$news->created_at}}</td></tr>
			@if($news->medias->first() != null)
			<tr><td><img src="{{url(App\Models\News::IMAGE_LOCATION.'/'.$news->medias->first()->image)}}"></td></tr>
			@endif
			<tr><td>{!! nl2br(e($news->content)) !!}</td></tr>
		</tbody>
	</table>
</body>
</html>