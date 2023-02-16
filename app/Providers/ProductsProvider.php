<?php

namespace App\Providers;
use App\Repository\Products\ProductsServiceInterface;
use App\Repository\Products\ProductsService;

use Illuminate\Support\ServiceProvider;

class ProductsProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(ProductsServiceInterface::class , ProductsService::class);
        
    }


    public function boot()
    {
        //
    }
}
