<?php

namespace Database\Seeders;

use App\Models\CustomerCredit;
use Illuminate\Database\Seeder;

class CustomerCreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerCredit::factory(20)->create();
    }
}
