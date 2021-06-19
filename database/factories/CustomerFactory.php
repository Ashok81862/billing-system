<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name       =  $this->faker->name;
        $address    = $this->faker->address;
        $phone      =  $this->faker->phoneNumber;
        $reg_number = mt_rand(10000, 500000);

        return [
            'name'          => $name,
            'address'       =>  $address,
            'phone'         =>  $phone,
            'reg_number'    =>  $reg_number,
        ];
    }
}
