<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function store(CreatePostRequest $request)
    {
        
        $post = Post::create($request->validated());

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
    
    public function index()
    {
       
        $posts = Post::with('tags')->get();
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
