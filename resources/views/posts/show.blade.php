@extends('layouts.app')


@section('content')
   
<div class="container">
	 <div class="card">
	  <h5 class="card-header">{{$post->id}} - {{$post->title}}</h5>
	  <div class="card-body">
	    <h5 class="card-title">{{$post->content}}</h5>
	    <p class="card-text">{{$post->slug}}</p>
	  </div>
	</div>
	<br>
</div>

@endsection
