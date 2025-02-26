<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function showPost($id) {
        
        $post = Post::with('user', 'comments.user')->findOrFail($id);
        
        return view('post', compact('post'));
    }
}
