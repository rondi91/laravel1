<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $posts = Post::latest()->take(20)->get();

        return view('posts.index', compact('posts'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // dd(__FILE__,__LINE__,$request);
        
        // $this->authorize('create', Post::class); //memeriksa izin menggunakan policy

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        // $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post has been created!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post )
    {   
        // dd(__FILE__,__LINE__,$post);
        $post = $post;
        // $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        
        $request->validate([
            'title' => 'required',
            'excerpt' => 'required',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    


        // // Check if the user is authorized to delete the post
        // if (Gate::allows('delete-post', $post)) {
        //     $post->delete();
        //     return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        // } else {
        //     return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        // }
    }
}
