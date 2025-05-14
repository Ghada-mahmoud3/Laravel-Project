<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        // تعيين القرص الافتراضي إلى public
        config(['filesystems.default' => 'public']);

        // إزالة محاولة إنشاء الرابط الرمزي هنا
    }
}
