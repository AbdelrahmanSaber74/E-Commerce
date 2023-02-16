<?php

namespace App\Providers;

use App\Repository\Categories\CategoriesServiceInterface;
use App\Repository\Categories\CategoriesService;
use Illuminate\Support\ServiceProvider;


class CategoriesProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(CategoriesServiceInterface::class , CategoriesService::class);
        
    }


    public function boot()
    {
        //
    }
}
