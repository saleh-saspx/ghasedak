<?php

namespace Saspx\IranianSmsProviderPhp\src\Drivers;

use Illuminate\Support\Facades\Http;

class FarazSMS implements BaseDriver
{
    public string $apiUrl = 'https://api2.ippanel.com/api/v1';

    public function send($number, $text)
    {
        // TODO: Implement send() method.

    }

    public function validNumber(array|string ...$numbers)
    {
        if (!is_array($numbers)) {
            return '+98' . substr($numbers, -10, -7) . substr($numbers, -7, -4) . substr($numbers, -4);
        }
        if (!empty($numbers)) {
            $collection = collect();
            foreach ($numbers as $item => $number) {
                $_v = '+98' . substr($number, -10, -7) . substr($number, -7, -4) . substr($number, -4);
                $collection->put($item, $_v);
            }
            return $collection->toArray();
        }
        throw new \Exception('numbers empty', 400);
    }

    public function sendOTP(string $number, $code)
    {
        $number = $this->validNumber($number);
        if (is_array($number)){
            $number = collect($number)->first();
        }
        $request = $this->apiUrl . '/sms/pattern/normal/send';
        $httpClient = Http::withHeaders([
            'apikey' => config('sms_services.sms_maper.faraz_sms.API_KEY')
        ])->post($request, [
            'code' => config('sms_services.sms_maper.faraz_sms.SMS_OTP_VARIABLE_KEY'),
            'sender' => config('sms_services.sms_maper.faraz_sms.SENDER_NUMBER'),
            'recipient' => $number,
            'variable' => [
                config('sms_services.sms_maper.faraz_sms.OTP_VARIABLE_PATTERN') => $code
            ]
        ]);
        if ($httpClient->status() != 200) {
            throw new \Exception('Can not to send otp code', $httpClient->status(), $httpClient->object());
        }
        return true;
    }
}
