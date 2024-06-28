<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GitHubService;
use App\Services\GitHubServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GitHubServiceInterface::class, GitHubService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
