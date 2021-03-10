<?php


namespace App\Repositories;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepository
{
    function findAll(): Collection;
    public function findById(int $id): Order;
    function save(array $parameters): Order;
    function findByOrderNo(int $orderNo): ?Order;
    function update(array $data, int $id): bool;
    public function delete($id): void;
}
