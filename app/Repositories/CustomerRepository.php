<?php


namespace App\Repositories;


use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepository
{
    function findAll(): Collection;
    function findAllPhones(): array;
    public function findById(int $id): Customer;
    function save(array $parameters): Customer;
    function findByPhoneNumber(string $orderNo): ?Customer;
    function update(array $data, int $id): bool;
    public function delete($id): void;
}
