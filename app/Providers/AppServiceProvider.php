<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar directorios de vistas para cada dominio
        $domains = ['Category', 'Payment', 'Product', 'Promociones', 'Provider', 'Report', 'Sale'];
        
        foreach ($domains as $domain) {
            $viewPath = base_path("{$domain}/Views");
            if (is_dir($viewPath)) {
                $this->loadViewsFrom($viewPath, $domain);
            }
        }
    }
}