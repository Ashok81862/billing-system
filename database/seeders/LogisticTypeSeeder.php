<?php

namespace Database\Seeders;

use App\Models\LogisticType;
use Illuminate\Database\Seeder;

class LogisticTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogisticType::factory(15)->create();
    }
}
