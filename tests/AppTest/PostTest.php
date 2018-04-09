<?php

namespace AppTest;

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class CategoryTest
 *
 * @package AppTest
 *
 * @codingStandardsIgnoreFile
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class PostTest extends \TestCase
{
    use DatabaseMigrations;

    /**
     * @param $category
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getCategory($category) {
        return \App\Category::find($category->id);
    }

    /** @test, @group failing */
    public function it_works()
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
