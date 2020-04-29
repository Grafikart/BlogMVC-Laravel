<?php

namespace App\Observers;

use App\Category;
use App\Post;

class PostCountObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $post->category()->increment('posts_count');
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        $previous_category_id = $post->getOriginal('category_id');
        if ($previous_category_id != $post->category_id) {
            Category::where('id', $previous_category_id)->decrement('posts_count');
            $post->category()->increment('posts_count');
        }
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        $post->category()->decrement('posts_count');
    }
}
