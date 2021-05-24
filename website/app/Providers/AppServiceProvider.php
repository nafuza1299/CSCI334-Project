<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Http\Controllers\Admin\UserCrudController;

use App\Models\Business;
use App\Models\BusinessAddress;
use App\Models\CheckIn;
use App\Models\HealthOrgStatistic;
use App\Models\HealthStaff;
use App\Models\TestResult;
use App\Models\User;

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
        $this->app->singleton("Business", function ($app) {
            return new Business;
        });
        $this->app->singleton("BusinessAddress", function ($app) {
            return new BusinessAddress;
        });
        $this->app->singleton("CheckIn", function ($app) {
            return new CheckIn;
        });
        $this->app->singleton("HealthStaff", function ($app) {
            return new HealthStaff;
        });
        $this->app->singleton("HealthOrgStatistic", function ($app) {
            return new HealthOrgStatistic;
        });
        $this->app->singleton("TestResult", function ($app) {
            return new TestResult;
        });
        $this->app->singleton("User", function ($app) {
            return new User;
        });
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
