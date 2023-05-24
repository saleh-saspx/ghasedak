<?php

namespace Saspx\IranianSmsProviderPhp\src\Drivers;

interface BaseDriver
{
    public function send(array|string $number, array|string $text);

    public function sendOTP(string $number, $code);
}
