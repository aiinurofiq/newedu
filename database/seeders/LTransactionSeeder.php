<?php

namespace Database\Seeders;

use App\Models\LTransaction;
use Illuminate\Database\Seeder;

class LTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LTransaction::factory()
            ->count(5)
            ->create();
    }
}
