<?php

namespace Database\Factories;

use App\Models\CustomerCredit;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerCreditFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerCredit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer_id = mt_rand(1,20);
        $amount = mt_rand(100,1000);
        $sale_id = mt_rand(1,20);
        $is_fully_paid = mt_rand(0,1);

        return [
            'customer_id' => $customer_id,
            'total_amount' => $amount,
            'is_fully_paid' => $is_fully_paid,
            'sale_id'   =>  $sale_id,
        ];
    }
}
