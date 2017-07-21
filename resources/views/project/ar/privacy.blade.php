@extends('project.ar.layout.master')
@section('content')

<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>Privacy  <span> policy </span> </h2>
    </div>
  </div>
</div>



<div class="tc">
  <div class="container">
    <div class="col-md-12 no-padding">
       <div class="tc-sec">
          @foreach($privacies as $privacy)
          <h4>{{$privacy->serial_number}}. {{$privacy->translate('title')}} </h4>
             <p>{!! nl2br(e($privacy->translate('content'))) !!}</p>
          @endforeach
       </div>
    </div>
  </div>
</div>

@endsection