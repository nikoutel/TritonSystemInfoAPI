<?php

namespace App\Providers;

use App\System\SystemInterface;
use Illuminate\Support\ServiceProvider;

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
    }
}
