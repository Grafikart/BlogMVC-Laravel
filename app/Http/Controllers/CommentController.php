<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        $comment = Comment::create($request->all());

        return redirect()->route('posts.show', ['slug' => $comment->post->slug])
                         ->with('success', 'Thanks for your comment');
    }
}
