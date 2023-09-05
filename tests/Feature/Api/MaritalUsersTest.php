<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Marital;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaritalUsersTest extends TestCase
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
    public function it_gets_marital_users(): void
    {
        $marital = Marital::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'marital_id' => $marital->id,
            ]);

        $response = $this->getJson(route('api.maritals.users.index', $marital));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_marital_users(): void
    {
        $marital = Marital::factory()->create();
        $data = User::factory()
            ->make([
                'marital_id' => $marital->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.maritals.users.store', $marital),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($marital->id, $user->marital_id);
    }
}
