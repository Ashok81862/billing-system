<?php

namespace Database\Factories;

use App\Models\Logistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Logistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $logistic_type_id = mt_rand(1,15);
        $amount =  mt_rand(1000,10000);
        $remark = $this->faker->word(mt_rand(1,20),true);

        return [
            'logistic_type_id'  =>  $logistic_type_id,
            'amount'            =>  $amount,
            'remark'            =>  $remark
        ];
    }
}
