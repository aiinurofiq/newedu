<?php

namespace Database\Seeders;

use App\Models\Categorylearn;
use Illuminate\Database\Seeder;

class CategorylearnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorylearn::factory()
            ->count(5)
            ->create();
    }
}
