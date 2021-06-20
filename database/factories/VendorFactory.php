<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name           =  $this->faker->name;
        $address        = $this->faker->address;
        $phone          =  $this->faker->phoneNumber;
        $reg_number     = mt_rand(10000, 500000);
        $category_id    = mt_rand(1,15);

        return [
            'name'          => $name,
            'address'       =>  $address,
            'phone'         =>  $phone,
            'reg_number'    =>  $reg_number,
            'category_id'   =>  $category_id,
        ];
    }
}
