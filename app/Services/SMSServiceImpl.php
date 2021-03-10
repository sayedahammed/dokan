<?php


namespace App\Services;


use App\Gateway\SMSGateway;
use Illuminate\Http\JsonResponse;

class SMSServiceImpl implements SMSService
{
    private SMSGateway $SMSGateway;

    public function __construct(SMSGateway $SMSGateway)
    {
        $this->SMSGateway = $SMSGateway;
    }

    /**
     * @param array $msisdn
     * @param string $message
     * @param string $campaign
     * @return mixed
     */
    public function send(array $msisdn, string $message): string
    {
        $limitMsisdn = array_slice($msisdn, 0, 499);

        return $this->SMSGateway->send($limitMsisdn, $message);
    }

    /**
     * @return JsonResponse
     */
    public function balance(): JsonResponse
    {
       return $this->SMSGateway->getBalance();
    }
}
