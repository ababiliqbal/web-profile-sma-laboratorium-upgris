<?php

namespace App\Providers;

use App\Http\View\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SettingComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', SettingComposer::class);
        View::composer('layouts.partials.navbar', NavigationComposer::class);
    }
}
