<?php

namespace App\Providers;

use App\Repositories\role\RoleRepository;
use App\Repositories\role\RoleRepositoryInterface;
use App\Repositories\todo\TodoRepository;
use App\Repositories\todo\TodoRepositoryInterface;
use App\Repositories\user\UserRepository;
use App\Repositories\user\UserRepositoryInterface;
use App\Show\Facade\ShowFacade;
use App\Show\ShowManager;
use Illuminate\Pagination\Paginator;
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
        $this->app->singleton('test',function (){
            return new \App\test();
        });
        $this->app->singleton(TodoRepositoryInterface::class, TodoRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton('show',function(){
            return new ShowManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
        $this->registerShow();
    }

    protected function registerShow(){
        ShowFacade::add('facades','facades');
    }
}
