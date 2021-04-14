<?php

namespace KPAWork\MSG4wrdIO;

use Illuminate\Support\ServiceProvider;

class MSG4wrdIOServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'msg4wrd-io');
    }

    public function register()
    {
        $this->app->make('KPAWork\MSG4wrdIO\Http\Controllers\MSG4wrdIOController');
    }
}
