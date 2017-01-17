<?php

namespace App\Observers;

use App\Category;
use App\Post;

class PostCountObserver
{

    public function created(Post $post)
    {
        $post->category()->increment('posts_count');
    }

    public function deleted(Post $post)
    {
        $post->category()->decrement('posts_count');
    }

    public function updating(Post $post)
    {
        $previous_category_id = $post->getOriginal('category_id');
        if ($previous_category_id != $post->category_id) {
            Category::where('id', $previous_category_id)->decrement('posts_count');
            Category::where('id', $post->category_id)->increment('posts_count');
        }
    }

}