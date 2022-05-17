<?php

namespace App\Providers;

use App\Models\Empresa;
use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton('restaurante', function ($app) {
            return Empresa::query()->with('parametros')->find(auth()->user()->empresa->id);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($money) {
            return 'R$ ' . "<?php echo number_format($money, 2, ',', '.'); ?>";
        });
    }
}
