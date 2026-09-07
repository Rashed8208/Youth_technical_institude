<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use App\Enums\BranchApplicationStatus;
use App\Models\BranchApplication;
use Illuminate\Support\Facades\View;
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
        // Force HTTPS in Codespaces or Proxy environment
        if (request()->server('HTTP_X_FORWARDED_PROTO') == 'https' || env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        View::composer('components.dashboard-shell', function ($view): void {
            $view->with([
                'adminNavigation' => config('admin_navigation'),
                'pendingBranchApplications' => BranchApplication::query()
                    ->where('status', BranchApplicationStatus::Pending->value)
                    ->count(),
            ]);
        });
    }
}