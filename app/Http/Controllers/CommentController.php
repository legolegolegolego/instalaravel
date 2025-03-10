<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function showCommentForm($id)
    {
        $post = Post::findOrFail($id);
        return view('comment-form', compact('post'));
    }
}
