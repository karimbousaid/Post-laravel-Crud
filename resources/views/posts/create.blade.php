@extends('layouts.app')

@section('content')
    <div class="container">
    	<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        
        @include('posts._form')

        <button type="submit" class="btn btn-primary btn-block">Create!</button>
    </form>
    </div>
@endsection