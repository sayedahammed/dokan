<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepositoryImpl implements CustomerRepository
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function findAll(): Collection
    {
        return Customer::latest()->get();
    }

    /**
     * @return array
     */
    function findAllPhones(): array
    {
        return Customer::paginate(499)->pluck('phone')->toArray();
    }

    /**
     * @param array $parameters
     * @return Order
     */
    public function save(array $parameters): Customer
    {
        $customer = Customer::updateOrCreate(
            ['phone' => $parameters['phone']],
            ['name' => $parameters['name']]
        );

        return $customer;
    }

    /**
     * @param int $orderNo
     * @return Order
     */
    public function findByPhoneNumber(string $phone): ?Customer
    {
        return Customer::where('phone', $phone)->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id): Customer
    {
        return Customer::findOrFail($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $order = $this->findById($id);
        return $order->update($data);
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function delete($id): void
    {
        $customer = $this->findById($id);
        $customer->delete();
    }
}
