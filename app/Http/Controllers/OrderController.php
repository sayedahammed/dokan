<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    protected OrderRepository $orderRepository;

    function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $orders = $this->orderRepository->findAll();
        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrder $request): RedirectResponse
    {
        $parameters = $request->validated();

        $parameters['status'] = false;

        $this->orderRepository->save($parameters);

        return redirect()->route('customers.show', $parameters['customer_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|RedirectResponse
     */
    public function search(Request $request)
    {
        $orderNo = $request->input('order_no', null);

        $order = $this->orderRepository->findByOrderNo($orderNo);

        if (empty($order)) {
            return \redirect()->route('orders.index')->with('order-not-found', 'Opps! No order found!');
        }

        return \view('orders.show', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param int   $id
     * @return View
     */
    public function show($id): View
    {
        $order = $this->orderRepository->findByOrderNo($id);
        return \view('orders.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->orderRepository->update(['status' => true], $id);

        return redirect()->back()->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->orderRepository->delete($id);

        return \redirect()->back()->with('delete-success', 'Order deleted successfully.');
    }
}
