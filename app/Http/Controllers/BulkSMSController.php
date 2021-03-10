<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendBulkSMS;
use App\Http\Requests\StoreBulkSMS;
use App\Repositories\BulkSMSRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\TestUserRepository;
use App\Services\SMSService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BulkSMSController extends Controller
{
    private SMSService $SMSService;
    private TestUserRepository $testUserRepository;
    private CustomerRepository $customerRepository;

    public function __construct(TestUserRepository $testUserRepository,
                                  SMSService $SMSService,
                                  CustomerRepository $customerRepository
    ) {
        $this->SMSService = $SMSService;
        $this->testUserRepository = $testUserRepository;
        $this->customerRepository = $customerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('bulk-sms.index');
    }

    /**
     * Send Bulk SMS Method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SendBulkSMS $request)
    {
        $message = $request->get('message');

        switch ($request->get('user_type')) {
            case 1:
                $msisdn = $this->testUserRepository->findAllPhones();
                $response = $this->SMSService->send($msisdn, $message);
                break;
            case 2:
                $msisdn = $this->customerRepository->findAllPhones();
                $response = $this->SMSService->send($msisdn, $message);
                break;
        }

        return redirect()->back()->with('success', $response);
    }

    /**
     * @return JsonResponse
     */
    public function balance(): JsonResponse
    {
        return $this->SMSService->balance();
    }

}
