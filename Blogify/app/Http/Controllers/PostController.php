<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'tags' => 'required',
        ]);

        
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->tags = $request->input('tags');
        $post->save();

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
    
    public function index()
    {
       
        $posts = Post::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }


}
