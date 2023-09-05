<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Tribe;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TribeUsersTest extends TestCase
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
    public function it_gets_tribe_users(): void
    {
        $tribe = Tribe::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'tribe_id' => $tribe->id,
            ]);

        $response = $this->getJson(route('api.tribes.users.index', $tribe));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_tribe_users(): void
    {
        $tribe = Tribe::factory()->create();
        $data = User::factory()
            ->make([
                'tribe_id' => $tribe->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.tribes.users.store', $tribe),
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

        $this->assertEquals($tribe->id, $user->tribe_id);
    }
}
