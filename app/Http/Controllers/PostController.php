<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\User;

class PostController extends Controller
{

    private $per_page = 5;

    public function index()
    {
        $posts = Post::with('category', 'user')->paginate($this->per_page);
        return view('posts.index', compact('posts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::with('category', 'user')->where('category_id', $category->id)->paginate($this->per_page);
        return view('posts.index', compact('posts', 'category'));
    }

    public function user($user_id)
    {
        $user = User::find($user_id);
        $posts = Post::with('category', 'user')->where('user_id', $user->id)->paginate($this->per_page);
        return view('posts.index', compact('posts', 'user'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comment = new Comment(['post_id' => $post->id]);
        return view('posts.show', compact('post', 'comment'));
    }

}