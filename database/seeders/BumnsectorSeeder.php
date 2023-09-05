<?php

namespace Database\Seeders;

use App\Models\Bumnsector;
use Illuminate\Database\Seeder;

class BumnsectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bumnsector::factory()
            ->count(5)
            ->create();
    }
}
