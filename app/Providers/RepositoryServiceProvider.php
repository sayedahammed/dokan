<?php

namespace App\Providers;

use App\Repositories\BulkSMSRepository;
use App\Repositories\BulkSMSRepositoryImpl;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerRepositoryImpl;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryImpl;
use App\Repositories\TestUserRepository;
use App\Repositories\TestUserRepositoryImpl;
use App\Services\SMSService;
use App\Services\SMSServiceImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            OrderRepository::class,
            OrderRepositoryImpl::class
        );

        $this->app->bind(
            CustomerRepository::class,
            CustomerRepositoryImpl::class
        );

        $this->app->bind(
            TestUserRepository::class,
            TestUserRepositoryImpl::class
        );

        $this->app->bind(
            SMSService::class,
            SMSServiceImpl::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
