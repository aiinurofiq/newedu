<?php

namespace Database\Seeders;

use App\Models\Exsum;
use Illuminate\Database\Seeder;

class ExsumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exsum::factory()
            ->count(5)
            ->create();
    }
}
