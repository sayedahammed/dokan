<?php


namespace App\Repositories;


use App\Models\TestUser;

class TestUserRepositoryImpl implements TestUserRepository
{

    /**
     * @return array
     */
    function findAllPhones(): array
    {
        return TestUser::all()->pluck('phone')->toArray();
    }
}
