<?php

namespace Database\Seeders;

use App\Models\Valvision;
use Illuminate\Database\Seeder;

class ValvisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Valvision::factory()
            ->count(5)
            ->create();
    }
}
