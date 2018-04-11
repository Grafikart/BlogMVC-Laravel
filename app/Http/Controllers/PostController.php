<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Category;

/**
 * Class PostController
 *
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @var int
     */
    private $perPage = 5;

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->paginate($this->perPage);

        return view('posts.index', compact('posts'));
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::with('category', 'user')
                     ->where('category_id', $category->id)
                     ->paginate($this->perPage);

        return view('posts.index', compact('posts', 'category'));
    }

    /**
     * @param int $userId
     *
     * @return \Illuminate\View\View
     */
    public function user($userId)
    {
        $user = User::find($userId);
        $posts = Post::with('category', 'user')->where('user_id', $user->id)->paginate($this->perPage);

        return view('posts.index', compact('posts', 'user'));
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comment = new Comment(['post_id' => $post->id]);

        return view('posts.show', compact('post', 'comment'));
    }
}
