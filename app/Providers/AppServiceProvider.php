<?php

namespace App\Providers;

use App\Observers\PostCountObserver;
use App\Post;
use cebe\markdown\GithubMarkdown;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GithubMarkdown::class, fn($app) => new GithubMarkdown());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostCountObserver::class);
    }
}
