<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\User;
use App\Category;
use App\Http\Requests\PostRequest;

/**
 * Class PostController
 *
 * @package App\Http\Controllers\Admin
 */
class PostController extends \App\Http\Controllers\Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(10);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('admin.posts.new', compact('post', 'categories', 'users'));
    }

    /**
     * @param PostRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        Post::create($request->all());

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post created successfully');
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('admin.posts.new', compact('post', 'categories', 'users'));
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post updated successfully');
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Post destroyed successfully');
    }
}
