<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order_id = mt_rand(1,20);
        $product_id = mt_rand(1,30);
        $quantity = mt_rand(1,100);
        $unit_price = mt_rand(100,5000);

        return [
            'order_id'      =>  $order_id,
            'product_id'    =>  $product_id,
            'quantity'      =>  $quantity,
            'unit_price'    =>  $unit_price
        ];
    }
}
