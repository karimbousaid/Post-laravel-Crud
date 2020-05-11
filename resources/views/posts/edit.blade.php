@extends('layouts.app')

@section('content')
  <div class="container">
  	  <form method="POST" 
          action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('posts._form')

        <button type="submit" class="btn btn-primary btn-block">Update!</button>
    </form>
  </div>
@endsection