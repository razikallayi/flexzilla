@extends('project.ar.layout.master')
@section('content')

<div class="abt-tp">
  <div class="container">
    <div class="col-md-12 no-padding">
      <h2>Terms & <span> Conditions </span> </h2>
    </div>
  </div>
</div>



<div class="tc">
  <div class="container">
    <div class="col-md-12 no-padding">
       <div class="tc-sec">
          @foreach($terms as $term)
          <h4>{{$term->serial_number}}. {{$term->translate('title')}} </h4>
             <p>{!! nl2br(e($term->translate('content'))) !!}</p>
          @endforeach
       </div>
    </div>
  </div>
</div>



@endsection