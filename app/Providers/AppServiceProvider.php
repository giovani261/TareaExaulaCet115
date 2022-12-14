<?php

namespace App\Providers;

use App\Models\CartManager;
use Illuminate\Support\ServiceProvider;
use App\Models\Categorias;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartManager::class, function () {
            return new CartManager();
        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        $categorias = Categorias::all();
        config(['Categorias' => $categorias]);
    }
}
