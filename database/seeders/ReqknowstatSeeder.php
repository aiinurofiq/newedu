<?php

namespace Database\Seeders;

use App\Models\Reqknowstat;
use Illuminate\Database\Seeder;

class ReqknowstatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reqknowstat::factory()
            ->count(5)
            ->create();
    }
}
