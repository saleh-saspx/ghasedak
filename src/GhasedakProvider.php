<?php

namespace Saspx\IranianSmsProviderPhp\src;

use Illuminate\Support\ServiceProvider;

class GhasedakProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->publishes([
            __DIR__ . "/config/sms_services.php" => config_path('sms_services.php')
        ], 'config');
        $this->mergeConfigFrom(__DIR__ . "/config/sms_services.php", 'sms_services');
    }
}
