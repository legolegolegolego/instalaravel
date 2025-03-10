<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function showCommentForm($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments ?? collect();
        return view('comment-form', compact('post'));
    }
}
