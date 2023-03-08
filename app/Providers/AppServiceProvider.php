<?php

namespace App\Providers;

use App\Repositories\IMailRepository;
use App\Repositories\IPostRepository;
use App\Repositories\ISearchRepository;
use App\Repositories\ITagRepository;
use App\Repositories\IUserRepository;
use App\Repositories\MailRepository;
use App\Repositories\PostRepository;
use App\Repositories\SearchRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(ITagRepository::class, TagRepository::class);
        $this->app->bind(ISearchRepository::class, SearchRepository::class);
        $this->app->bind(IMailRepository::class, MailRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
