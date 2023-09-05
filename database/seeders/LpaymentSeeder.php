<?php

namespace Database\Seeders;

use App\Models\Lpayment;
use Illuminate\Database\Seeder;

class LpaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lpayment::factory()
            ->count(5)
            ->create();
    }
}
