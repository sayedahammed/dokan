<?php


namespace App\Repositories;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepositoryImpl implements OrderRepository
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function findAll(): Collection
    {
        return Order::latest()->get();
    }

    /**
     * @param array $parameters
     * @return Order
     */
    public function save(array $parameters): Order
    {
        $order = new Order();
        $order->customer_id = $parameters['customer_id'];
        $order->order_no = $parameters['order_no'];
        $order->status = $parameters['status'];
        $order->save();

        return $order;
    }

    /**
     * @param int $orderNo
     * @return Order
     */
    public function findByOrderNo(int $orderNo): ?Order
    {
        return Order::where('order_no', $orderNo)->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return Order::findOrFail($id);
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
}
