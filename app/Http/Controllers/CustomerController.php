<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomer;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $customers = $this->customerRepository->findAll();
        return view('customers.index', compact('customers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|RedirectResponse
     */
    public function search(Request $request)
    {
        $phoneNumber = $request->input('phone', null);

        $customer = $this->customerRepository->findByPhoneNumber($phoneNumber);

        if (empty($customer)) {
            return \redirect()->back()->with('customer-not-found', 'Opps! No customer found!');
        }

        return \view('customers.show', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCustomer $request): RedirectResponse
    {
        $parameters = $request->validated();

        $customer = $this->customerRepository->save($parameters);

        return redirect()->route('customers.show', $customer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        $customer = $this->customerRepository->findById($id);

        return \view('customers.show', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->customerRepository->delete($id);

        return \redirect()->back()->with('delete-success', 'Customer deleted successfully.');
    }
}
