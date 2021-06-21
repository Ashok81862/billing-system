<?php

namespace Database\Factories;

use App\Models\CustomerPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer_credit_id = mt_rand(1,20);
        $paid_amount = mt_rand(100,1000);

        return [
            'paid_amount' => $paid_amount,
            'customer_credit_id' => $customer_credit_id,
        ];
    }
}
