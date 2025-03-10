<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showCommentForm($id)
    {

        $post = Post::findOrFail($id);
        $comments = $post->comments ?? collect();
        return view('comment-form', compact('post', 'comments'));
    }

    public function commentPost($id){
        $post = Post::findOrFail($id);
        $data = request()->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->publish_date = now();
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('post', $post->id)->with('success', 'Comment created successfully.');
    }
}
