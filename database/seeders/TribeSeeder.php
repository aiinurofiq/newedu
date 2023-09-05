<?php

namespace Database\Seeders;

use App\Models\Tribe;
use Illuminate\Database\Seeder;

class TribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tribe::factory()
            ->count(5)
            ->create();
    }
}
