<?php

namespace App\Providers;

use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\OrderRepositoryInterface::class, \App\Repositories\Eloquent\OrderRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\CouponRepositoryInterface::class, \App\Repositories\Eloquent\CouponRepository::class);
        $this->app->bind(\App\Repositories\Interfaces\WishlistRepositoryInterface::class, \App\Repositories\Eloquent\EloquentWishlistRepository::class);
        $this->app->bind(\App\Services\Payment\PaymentProviderInterface::class, \App\Services\Payment\StripeProvider::class);
    }

    public function boot()
    {
        //
    }
}
