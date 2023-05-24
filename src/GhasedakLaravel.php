<?php

namespace Saspx\IranianSmsProviderPhp\src;

use Saspx\IranianSmsProviderPhp\src\Drivers\BaseDriver;

class GhasedakLaravel implements BaseDriver
{
    public null|string $driverName = null;
    public $provider;

    public function getConfig($driver)
    {
        $config = config('sms_services.sms_maper');
        return $config[$driver] ?? null;
    }

    public function driver($driver = null)
    {
        $this->driverName = $driver;
        if (is_null($this->driverName)) {
            $this->driverName = config('sms_services.default_sms_sender');
        }
        $config = $this->getConfig($this->driverName);
        if (!isset($config['map']))
            throw new \Exception('provider undefined', 400);
        if (!class_exists($config['map']))
            throw new \Exception('provider map not exists class', 400);

        $this->provider = new $config['map'];
        return $this;
    }

    public function send(array|string $number, array|string $text)
    {
        return $this->provider->send($number, $text);
    }

    public function sendOTP(string $number, $code)
    {
        return $this->provider->sendOTP($number, $code);
    }
}
