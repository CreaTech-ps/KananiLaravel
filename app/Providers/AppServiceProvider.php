<?php

namespace App\Providers;

use App\Models\SeoSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $helpers = base_path('app/Helpers/helpers.php');
        if (file_exists($helpers)) {
            require_once $helpers;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // مشاركة إعدادات SEO مع layout الموقع الأمامي
        View::composer('website.layout', function ($view) {
            $siteSetting = DB::table('site_settings')->first();
            $view->with('siteSetting', $siteSetting);
            $seo = DB::table('seo_settings')->first();
            $view->with('seo', $seo);
        });

        // مشاركة إعدادات الموقع (السوشال ميديا) مع navbar المتجر
        View::composer('store.partials.navbar', function ($view) {
            $siteSetting = Schema::hasTable('site_settings')
                ? DB::table('site_settings')->first()
                : null;
            $view->with('siteSetting', $siteSetting);
        });
    }
}
