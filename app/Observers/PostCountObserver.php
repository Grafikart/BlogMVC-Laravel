<?php

namespace App\Observers;

use App\Post;
use App\Category;

/**
 * Class PostCountObserver
 *
 * @package App\Observers
 */
class PostCountObserver
{
    /**
     * @param Post $post
     */
    public function created(Post $post)
    {
        $post->category()->increment('posts_count');
    }

    /**
     * @param Post $post
     */
    public function deleted(Post $post)
    {
        $post->category()->decrement('posts_count');
    }

    /**
     * @param Post $post
     */
    public function updating(Post $post)
    {
        $previousCategoryId = $post->getOriginal('category_id');

        if ($previousCategoryId !== $post->category_id) {
            Category::where('id', $previousCategoryId)->decrement('posts_count');
            Category::where('id', $post->category_id)->increment('posts_count');
        }
    }
}
