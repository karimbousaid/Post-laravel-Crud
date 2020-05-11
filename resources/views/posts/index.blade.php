@extends('layouts.app')


@section('content')
   
<div class="container">

      <a href="{{route('posts.create')}}" class="btn btn-primary">Create New Post</a>

      <div class="my-3">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link @if($tab=='list') active @endif" href="/posts">List</a>
            <a class="nav-item nav-link @if($tab=='archive') active @endif" href="/posts/archive">Archive</a>
            <a class="nav-item nav-link @if($tab=='all') active @endif" href="/posts/all">All</a>
          </div>
        </nav>
      </div>

      <div class="my-3">
        <h4>{{$posts->count()}} Posts(s)</h4>
      </div>

  <br>
	@foreach ($posts as $post)
	 <div class="card">
	  <h5 class="card-header">{{$post->id}} - {{$post->title}}</h5>
	  <div class="card-body">
	    <h5 class="card-title">{{$post->content}}</h5>
	    <p class="card-text">{{$post->slug}}</p>

         @if($post->comments_count)
         <div>
         	<span class="badge badge-success">{{$post->comments_count}} comments</span>
         </div>
         @else
          <div>
         	<span class="badge badge-dark">No Comments yes</span>
         </div>
         @endif
        
      @if(!$post->deleted_at)
	    <form action="{{route('posts.destroy',['post' => $post->id])}}" method="POST">
                  @method('DELETE')
                  @csrf
                  <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-primary btn-sm">Show</a>
                  <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-warning btn-sm">Edit</a>
                  <button type="submit" class="btn btn-dark btn-sm" value="delete">Delete</button>
      </form>
      @else
      <form action="{{url('posts/'.$post->id.'/Restore')}}" method="POST">
                  @csrf
                  @method('PUT')
                  <a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-primary btn-sm">Show</a>
                  <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-warning btn-sm">Edit</a>
                  <button type="submit" class="btn btn-success btn-sm" value="restore">Restore</button>
      </form>
      <div class="my-3">
        <form action="{{url('posts/'.$post->id.'/forcedelete')}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm" value="forcedelete">force delete</button>
        </form>
      </div>
      @endif

	  </div>
	</div>
	<br>
    @endforeach
</div>

@endsection
