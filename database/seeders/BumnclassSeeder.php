<?php

namespace Database\Seeders;

use App\Models\Bumnclass;
use Illuminate\Database\Seeder;

class BumnclassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bumnclass::factory()
            ->count(5)
            ->create();
    }
}
