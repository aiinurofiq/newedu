<?php

namespace Database\Seeders;

use App\Models\Bloodtype;
use Illuminate\Database\Seeder;

class BloodtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bloodtype::factory()
            ->count(5)
            ->create();
    }
}
