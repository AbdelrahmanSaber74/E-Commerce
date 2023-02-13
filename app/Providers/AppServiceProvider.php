<?php

namespace App\Providers;

use App\Models\Setting;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        if(!app()->runningInConsole() ) {

        $Setting = Setting::firstOr( function () {

            Setting::create([
                'name' => 'Site Name' ,
                'description' => 'description Name' ,
            ]);

        });

    }

}
}
