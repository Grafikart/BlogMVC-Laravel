<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    public function getCategory($category) {
        return \App\Category::find($category->id);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCounterCache()
    {
        $category1 = factory(\App\Category::class)->create();
        $category2 = factory(\App\Category::class)->create();
        $this->assertEquals(0, $this->getCategory($category1)->posts_count);
        $this->assertEquals(0, $this->getCategory($category2)->posts_count);
        // Create
        $post = factory(\App\Post::class)->create(['category_id' => $category1->id]);
        $this->assertEquals(1, $this->getCategory($category1)->posts_count);
        $post = factory(\App\Post::class)->create(['category_id' => $category1->id]);
        $this->assertEquals(2, $this->getCategory($category1)->posts_count);

        // Update
        $post->update(['category_id' => $category2->id]);
        $this->assertEquals(1, $this->getCategory($category1)->posts_count);
        $this->assertEquals(1, $this->getCategory($category2)->posts_count);

        // Destroy
        $post->delete();
        $this->assertEquals(1, $this->getCategory($category1)->posts_count);
        $this->assertEquals(0, $this->getCategory($category2)->posts_count);
    }
}
