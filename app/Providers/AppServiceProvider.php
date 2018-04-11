<?php

namespace App\Providers;

use App\Post;
use cebe\markdown\GithubMarkdown;
use App\Observers\PostCountObserver;
use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostCountObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->singleton(GithubMarkdown::class, function ($app) {
            return new GithubMarkdown();
        });
    }
}
