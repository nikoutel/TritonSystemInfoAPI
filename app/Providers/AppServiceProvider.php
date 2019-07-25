<?php

namespace App\Providers;

use App\System\SystemInterface;
use Illuminate\Support\ServiceProvider;
use Nikoutel\HelionConfig\HelionConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $namespacedConcreteSystem = 'App\System\\' . php_uname('s');
        $this->app->bind(SystemInterface::class, $namespacedConcreteSystem);

        $this->app->singleton(HelionConfig::class);
    }
}
