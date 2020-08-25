<?php

namespace App\Providers;

use App\Models\Timezone;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->applyMySqlLimitation();
    }

    /**
     * Apply the MySql limitation for strings
     * to support older MySql versions.
     *
     * @return void
     */
    private function applyMySqlLimitation(): void
    {
        Schema::defaultStringLength(191);
    }
}
