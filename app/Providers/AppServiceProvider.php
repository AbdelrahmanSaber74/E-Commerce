<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        \Illuminate\Support\Facades\Blade::directive('money', function ($expression) {
            return "<?php echo \App\Helpers\CurrencyHelper::format((float) $expression); ?>";
        });

        if (!app()->runningInConsole()) {
            $settingRepository = app(\App\Repositories\Interfaces\SettingRepositoryInterface::class);
            $setting = $settingRepository->getSettings();
            
            if (!$setting) {
                $setting = \App\Models\Setting::create([
                    'name' => 'Site Name',
                    'description' => 'Site Description',
                ]);
            }

            view()->share('setting', $setting);
        }
    }
}
