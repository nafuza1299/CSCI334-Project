<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Http\Controllers\Admin\UserCrudController;
use Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class, //this is package controller
            \app\Http\Controllers\Admin\UserCrudController::class //this should be your own controller
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
