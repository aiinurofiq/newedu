<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->unique->uuid(),
            'nik' => $this->faker->text(255),
            'kopeg' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'birth' => $this->faker->date(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique->email(),
            'npwp' => $this->faker->text(255),
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'remember_token' => Str::random(10),
            'city_id' => \App\Models\City::factory(),
            'gender_id' => \App\Models\Gender::factory(),
            'religion_id' => \App\Models\Religion::factory(),
            'bloodtype_id' => \App\Models\Bloodtype::factory(),
            'marital_id' => \App\Models\Marital::factory(),
            'tribe_id' => \App\Models\Tribe::factory(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
