<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(): View
    {
        return view('analytics');
    }

    public function getDateRange(Request $request)
    {
        $from = $request->input('from_date', null);
        $to = $request->input('to_date', null);

        $customers = Customer::whereDateBetween('created_at', $from, $to);
        $orders = Order::whereDateBetween('created_at', $from, $to);
        $onProgress = Order::where('status', 0)->whereDateBetween('updated_at', $from, $to);
        $deliveries = Order::where('status', 1)->whereDateBetween('updated_at', $from, $to);

        $response = [
            'customers' => [
                'count' => $customers->count()
            ],
            'orders' => [
                'count' => $orders->count()
            ],
            'deliveries' => [
                'count' => $deliveries->count()
            ],
            'on_progress' => [
                'count' => $onProgress->count()
            ]
        ];

        return response()->json($response);
    }
}
