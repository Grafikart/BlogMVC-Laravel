<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment = Comment::create($request->all());
        return redirect()->route('posts.show', ['slug' => $comment->post->slug])->with('success', 'Thanks for your comment');
    }
}
