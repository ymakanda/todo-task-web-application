<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GitHubService;
use App\Services\GitHubServiceInterface;
use App\Services\TwilioService;
use App\Services\TwilioServiceInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GitHubServiceInterface::class, GitHubService::class);
        $this->app->bind(TwilioServiceInterface::class, TwilioService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
