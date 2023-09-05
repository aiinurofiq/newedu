<?php

namespace Database\Seeders;

use App\Models\Marital;
use Illuminate\Database\Seeder;

class MaritalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marital::factory()
            ->count(5)
            ->create();
    }
}
