<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function showPost($id) {
        
        $post = Post::with('user', 'comments.user')->findOrFail($id);
        // $post = Post::find($id);
        
        return view('post', compact('post'));
    }

    public function showAllPosts() {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts', compact('posts'));
    }
}
