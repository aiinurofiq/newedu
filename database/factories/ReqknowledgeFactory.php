<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Reqknowledge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReqknowledgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reqknowledge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(15),
            'explanation_id' => \App\Models\Explanation::factory(),
            'exsum_id' => \App\Models\Exsum::factory(),
            'report_id' => \App\Models\Report::factory(),
            'jurnal_id' => \App\Models\Jurnal::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
