<?php

namespace Tests\Feature\Api;

use App\Models\User;

use App\Models\City;
use App\Models\Tribe;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Religion;
use App\Models\Bloodtype;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_users_list(): void
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.users.index'));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user(): void
    {
        $data = User::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.users.store'), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user(): void
    {
        $user = User::factory()->create();

        $city = City::factory()->create();
        $gender = Gender::factory()->create();
        $religion = Religion::factory()->create();
        $bloodtype = Bloodtype::factory()->create();
        $marital = Marital::factory()->create();
        $tribe = Tribe::factory()->create();

        $data = [
            'nik' => $this->faker->text(255),
            'kopeg' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'birth' => $this->faker->date(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique->email(),
            'npwp' => $this->faker->text(255),
            'city_id' => $city->id,
            'gender_id' => $gender->id,
            'religion_id' => $religion->id,
            'bloodtype_id' => $bloodtype->id,
            'marital_id' => $marital->id,
            'tribe_id' => $tribe->id,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(route('api.users.update', $user), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $data['id'] = $user->id;

        $this->assertDatabaseHas('users', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('api.users.destroy', $user));

        $this->assertSoftDeleted($user);

        $response->assertNoContent();
    }
}
