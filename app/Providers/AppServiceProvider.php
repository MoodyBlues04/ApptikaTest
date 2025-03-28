<?php

namespace App\Providers;

use App\Modules\Api\Client;
use App\Services\ApiResponseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiResponseService::class, function () {
            return new ApiResponseService();
        });
        $this->app->singleton(Client::class, function () {
            return new Client();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->is('api/*')) {
            request()->headers->set('Accept', 'application/json');
        }
    }
}
