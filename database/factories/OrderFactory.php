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
        $customer_id = mt_rand(1,15);
        $sub_total = mt_rand(100,1000);
        $total = $sub_total +  mt_rand(100,1000);

        return [
            'customer_id'   =>  $customer_id,
            'sub_total' => $sub_total,
            'total' => $total,
        ];
    }
}
