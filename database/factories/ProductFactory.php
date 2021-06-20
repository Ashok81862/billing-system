<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name       = $this->faker->words(mt_rand(1,4),true);
        $body       = $this->faker->paragraph(1);
        $price      = mt_rand(500,1000);
        $on_sale    = mt_rand(0,1);
        $sale_price = $on_sale ? $price - mt_rand((int) ($price/50), (int) ($price/10)): "";
        $unit_id    = mt_rand(1,21);

        return [
            'name'          =>  $name,
            'body'          =>  $body,
            'price'         =>  $price,
            'on_sale'       =>  $on_sale,
            'sale_price'    =>  $sale_price,
            'unit_id'       =>  $unit_id
        ];
    }
}
