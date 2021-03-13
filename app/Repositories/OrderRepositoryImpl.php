<?php


namespace App\Repositories;


use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class OrderRepositoryImpl implements OrderRepository
{

    /**
     * @return Collection
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
        $order->order_date = $parameters['order_date'];
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
    public function findById(int $id): Order
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

    /**
     * @param $id
     * @throws Exception
     */
    public function delete($id): void
    {
        $order = $this->findById($id);
        $order->delete();
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return mixed
     */
    public function countByDateBetween(string $fromDate, string $toDate)
    {
       return Order::whereDateBetween('order_date', $fromDate, $toDate)->count();
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return mixed
     */
    public function countOnProgressByDateBetween(string $fromDate, string $toDate)
    {
        return Order::where('status', 0)->whereDateBetween('delivery_date', $fromDate, $toDate)->count();
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return mixed
     */
    public function countOnDeliveryByDateBetween(string $fromDate, string $toDate)
    {
        return Order::where('status', 1)->whereDateBetween('delivery_date', $fromDate, $toDate)->count();
    }
}
