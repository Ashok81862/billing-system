<?php

namespace Database\Seeders;

use App\Models\Logistic;
use Illuminate\Database\Seeder;

class LogisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Logistic::factory(25)->create();
    }
}
