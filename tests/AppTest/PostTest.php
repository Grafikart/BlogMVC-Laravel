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
     * @param \App\Category $category
     *
     * @return \App\Category
     */
    public function getCategory($category)
    {
        return \App\Category::find($category->id);
    }

    /** @test */
    public function post_model_modifications_changes_posts_count_value_in_category_model()
    {
        // Create 2 Categories
        $category1 = factory(\App\Category::class)->create();
        $category2 = factory(\App\Category::class)->create();

        // Assert posts_count is initialy equal to 0
        $this->assertEquals(0, $this->getCategory($category1)->posts_count, 'Category 1 should have 0 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Create Post 1 for Category 1
        $post1 = factory(\App\Post::class)->create(['category_id' => $category1->id]);
        // Assertions
        $this->assertEquals(1, $this->getCategory($category1)->posts_count, 'Category 1 should have 1 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Create Post 2 for Category 1
        factory(\App\Post::class)->create(['category_id' => $category1->id]);
        // Assertions
        $this->assertEquals(2, $this->getCategory($category1)->posts_count, 'Category 1 should have 2 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Update Post 1 and attach to Category 2
        $post1->update(['category_id' => $category2->id]);
        // Assertions
        $this->assertEquals(1, $this->getCategory($category1)->posts_count, 'Category 1 should have 1 post(s)');
        $this->assertEquals(1, $this->getCategory($category2)->posts_count, 'Category 2 should have 1 post(s)');

        // Delete Post 1
        $post1->delete();
        // Assertions
        $this->assertEquals(1, $this->getCategory($category1)->posts_count, 'Category 1 should have 1 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');
    }

    /** @test */
    public function post_counts_value_dont_change_if_PostCountObserver_is_disabled()
    {
        // Disable PostCountObserver by creating a mock of it.
        $this->app->bind(\App\Observers\PostCountObserver::class, function () {
            return $this->getMockBuilder(\App\Observers\PostCountObserver::class)
                        ->disableOriginalConstructor()
                        ->getMock();
        });

        // Create 2 Categories
        $category1 = factory(\App\Category::class)->create();
        $category2 = factory(\App\Category::class)->create();

        // Assert posts_count is initialy equal to 0
        $this->assertEquals(0, $this->getCategory($category1)->posts_count, 'Category 1 should have 0 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Create Post 1 for Category 1
        $post1 = factory(\App\Post::class)->create(['category_id' => $category1->id]);
        // Assertions
        $this->assertEquals(0, $this->getCategory($category1)->posts_count, 'Category 1 should have 0 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Create Post 2 for Category 1
        factory(\App\Post::class)->create(['category_id' => $category1->id]);
        // Assertions
        $this->assertEquals(0, $this->getCategory($category1)->posts_count, 'Category 1 should have 0 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Update Post 1 and attach to Category 2
        $post1->update(['category_id' => $category2->id]);
        // Assertions
        $this->assertEquals(0, $this->getCategory($category1)->posts_count, 'Category 1 should have 0 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');

        // Delete Post 1
        $post1->delete();
        // Assertions
        $this->assertEquals(0, $this->getCategory($category1)->posts_count, 'Category 1 should have 0 post(s)');
        $this->assertEquals(0, $this->getCategory($category2)->posts_count, 'Category 2 should have 0 post(s)');
    }
}
