<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fieldofposition;

class FieldofpositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fieldofposition::factory()
            ->count(5)
            ->create();
    }
}
