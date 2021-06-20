<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_id     =  mt_rand(1,30);
        $remark         =  $this->faker->paragraph(2);
        $quantity       =   mt_rand(1,100);

        return [
            'product_id'    =>  $product_id,
            'remark'        =>  $remark,
            'quantity'      =>  $quantity,
        ];
    }
}
