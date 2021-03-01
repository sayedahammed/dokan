<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 50),
            'order_no' => $this->faker->numberBetween(5000, 8000),
            'status' => $this->faker->numberBetween(0,1)
        ];
    }
}
