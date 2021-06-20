<?php

namespace Database\Factories;

use App\Models\LogisticType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogisticTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogisticType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'name'  =>  $name,
        ];
    }
}
