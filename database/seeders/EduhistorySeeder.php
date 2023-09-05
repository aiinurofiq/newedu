<?php

namespace Database\Seeders;

use App\Models\Eduhistory;
use Illuminate\Database\Seeder;

class EduhistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Eduhistory::factory()
            ->count(5)
            ->create();
    }
}
