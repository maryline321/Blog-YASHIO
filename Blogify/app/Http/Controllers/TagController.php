<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    // public function __invoke(Tag $tag)
    // {
    //     $post = $tag->posts();
    //     return TagResource::collection($post);
    // }
    public function index()  {
        return TagResource::collection(Tag::all());
    }
    public function showTag(Tag $tag)
    {
        
        // return response()->json($tag);    
        return $tag->with('posts')->where('id', $tag->id)->get();
    }
}
