<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    private CustomerRepository $customerRepository;
    private OrderRepository $orderRepository;

    public function __construct(CustomerRepository $customerRepository, OrderRepository $orderRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('analytics');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDateRange(Request $request)
    {
        $fromDate = $request->input('from_date', null);
        $toDate = $request->input('to_date', null);

        $customers = $this->customerRepository->countByDateBetween($fromDate, $toDate);
        $orders = $this->orderRepository->countByDateBetween($fromDate, $toDate);
        $onProgress = $this->orderRepository->countOnProgressByDateBetween($fromDate, $toDate);
        $deliveries = $this->orderRepository->countOnDeliveryByDateBetween($fromDate, $toDate);

        $response = [
            'customers' => [
                'count' => $customers
            ],
            'orders' => [
                'count' => $orders
            ],
            'deliveries' => [
                'count' => $deliveries
            ],
            'on_progress' => [
                'count' => $onProgress
            ]
        ];

        return response()->json($response);
    }
}
