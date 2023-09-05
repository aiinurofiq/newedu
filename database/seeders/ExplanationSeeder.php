<?php

namespace Database\Seeders;

use App\Models\Explanation;
use Illuminate\Database\Seeder;

class ExplanationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Explanation::factory()
            ->count(5)
            ->create();
    }
}
