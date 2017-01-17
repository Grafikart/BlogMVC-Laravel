<?php

namespace App\Providers;

use App\Category;
use App\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\View\Factory $viewFactory)
    {
        $viewFactory->composer('partials.sidebar', function ($view) {
            $view->with('categories', Category::all());
            $view->with('posts', Post::orderBy('created_at', 'desc')->limit(2)->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
