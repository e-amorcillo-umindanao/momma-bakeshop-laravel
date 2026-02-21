<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Audit;

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
        // Share low-stock products with all views (uses per-product threshold instead of hardcoded 10)
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $lowStockProducts = Product::whereColumn('Quantity', '<=', 'LowStockThreshold')->get();
                $view->with('lowStockProducts', $lowStockProducts);
            }
        });

        // Share recent audit entries with the dashboard
        View::composer('dashboard', function ($view) {
            $recentAudits = Audit::with('user')
                ->orderByDesc('DateAdded')
                ->take(10)
                ->get();
            $view->with('recentAudits', $recentAudits);
        });
    }
}
