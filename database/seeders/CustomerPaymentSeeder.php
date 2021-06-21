<?php

namespace Database\Seeders;

use App\Models\CustomerPayment;
use Illuminate\Database\Seeder;

class CustomerPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerPayment::factory(20)->create();
    }
}
