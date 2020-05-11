<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class PostController extends Controller
{

        public function __construct()
        {
            $this->middleware('auth')->only('create','update','destroy');
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index()
    {
        $posts=Post::withCount('comments')->orderBy('updated_at','desc')->get();
        return view('posts.index', [
            'posts' => $posts,
            'tab' => 'list'
        ]);
    }

    public function archive()
    {
        $posts=Post::onlyTrashed()->withCount('comments')->orderBy('updated_at','desc')->get();
        return view('posts.index', [
            'posts' => $posts,
            'tab' => 'archive'
        ]);
    }
    public function all()
    {
        $posts=Post::withTrashed()->withCount('comments')->orderBy('updated_at','desc')->get();
        return view('posts.index', [
            'posts' => $posts,
            'tab' => 'all'
        ]);
    }
    public function Restore($id)
    {
        $post=Post::onlyTrashed()->where('id',$id)->first();
        $post->restore();
        return redirect('/posts');
    }
    
    public function forcedelete($id)
    {
        $post=Post::onlyTrashed()->where('id',$id)->first();
        $post->forceDelete();
        return redirect('/posts');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\PostRequest $request)
    {

        $post = new Post();
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->slug=Str::slug($post->title,'-');
        $post->active=false;
        $post->save();

        /* $data=$request->only(['titre','content']);
        $data['slug']=Str::slug($post->title,'-');
        $data['active']=false;
        
        $post = Post::create($data);*/

        $request->session()->flash('status','Post was created');

        return redirect('/posts');
        // return redirect()->route('posts.show',['post' => $post->id]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'post' => Post::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $post = Post::findorFail($id);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\PostRequest $request,$id)
    {
        $post = Post::findorFail($id);
        $post->title= $request->input('title');
        $post->content= $request->input('content');
        $post->slug=Str::slug($post->title,'-');

        $post->save();
        
        $request->session()->flash('status','post was Updated');

        return redirect('/posts');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $post = Post::findorFail($post->id);
        
        $post->delete();
        
        $request->session()->flash('status','post was Deleted');

        return redirect('/posts');
    }
}
