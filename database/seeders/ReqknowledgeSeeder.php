<?php

namespace Database\Seeders;

use App\Models\Reqknowledge;
use Illuminate\Database\Seeder;

class ReqknowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reqknowledge::factory()
            ->count(5)
            ->create();
    }
}
