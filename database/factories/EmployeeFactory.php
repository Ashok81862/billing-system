<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

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
        $pan_number = mt_rand(10000, 500000);
        $position   =   $this->faker->word(mt_rand(1,3), true);
        $salary     =   mt_rand(10000,100000);

        return [
            'name'          => $name,
            'address'       =>  $address,
            'phone'         => $phone,
            'pan_number'    =>  $pan_number,
            'position'      => $position,
            'salary'        =>  $salary
        ];
    }
}
