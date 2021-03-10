<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

interface SMSService
{
    public function send(array $msisdn, string $message);
    public function balance(): JsonResponse;
}
