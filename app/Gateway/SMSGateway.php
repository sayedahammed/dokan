<?php

namespace App\Gateway;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SMSGateway
{
    private string $username;
    private string $password;
    private string $masking;

    public function __construct()
    {
        $this->username = env('SMS_API_USERNAME', '');
        $this->password = env('SMS_API_PASSWORD', '');
        $this->masking = env('SMS_API_MASKING', '');

    }
    public function send(array $msisdn, string $message): string
    {
        try {
            $msisdnCommSeparated = implode(',', $msisdn);

            $url = "https://api2.onnorokomsms.com/HttpSendSms.ashx?op=OneToMany&type=TEXT&mobile=$msisdnCommSeparated&smsText=$message&username=$this->username&password=$this->password&maskName=$this->masking&campaignName=";

            $response = Http::get($url)->body();

            Log::info("SMS Gateway: $response");

            return $response;

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function getBalance(): JsonResponse
    {
        $url = "https://api2.onnorokomsms.com/HttpSendSms.ashx?op=GetBalance&username=$this->username&password=$this->password&maskName=&campaignName=";

        $response = Http::get($url)->body();

        return response()->json(["balance" => $response]);
    }
}
