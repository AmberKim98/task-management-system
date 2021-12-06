<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       // Employee Registration
       $this->app->bind("App\Interfaces\Dao\Employee\EmployeeDaoInterface", "App\Dao\Employee\EmployeeDao");
       // Employee Business logic registration
       $this->app->bind("App\Interfaces\Services\Employee\EmployeeServiceInterface", "App\Services\Employee\EmployeeService"); 
        $this->app->bind("App\Interfaces\Services\Employee\EmployeeServiceInterface", "App\Services\Employee\EmployeeService"); 

        //Task Registration
        $this->app->bind("App\Interfaces\Dao\Task\TaskDaoInterface", "App\Dao\Task\TaskDao");
        //Task Business Logic registration
        $this->app->bind("App\Interfaces\Services\Task\TaskServiceInterface", "App\Services\Task\TaskService");
        //Project Registration
        $this->app->bind("App\Interfaces\Dao\Project\ProjectDaoInterface", "App\Dao\Project\ProjectDao");
        //Project Business Logic registration
        $this->app->bind("App\Interfaces\Services\Project\ProjectServiceInterface", "App\Services\Project\ProjectService");
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }
}
