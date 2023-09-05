<?php

namespace Database\Seeders;

use App\Models\Learning;
use Illuminate\Database\Seeder;

class LearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Learning::factory()
            ->count(5)
            ->create();
    }
}
