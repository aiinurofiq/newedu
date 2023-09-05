<?php

namespace Database\Seeders;

use App\Models\Wifhus;
use Illuminate\Database\Seeder;

class WifhusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wifhus::factory()
            ->count(5)
            ->create();
    }
}
