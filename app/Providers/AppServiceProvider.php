<?php

namespace App\Providers;

use App\Models\Tag;
use App\View\Components\Alert;
use App\View\Components\Tag as ComponentsTag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::component('package-alert', Alert::class);
        Blade::component('tags', ComponentsTag::class);
    }
}
