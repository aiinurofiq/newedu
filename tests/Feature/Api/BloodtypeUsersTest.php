<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bloodtype;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloodtypeUsersTest extends TestCase
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
    public function it_gets_bloodtype_users(): void
    {
        $bloodtype = Bloodtype::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'bloodtype_id' => $bloodtype->id,
            ]);

        $response = $this->getJson(
            route('api.bloodtypes.users.index', $bloodtype)
        );

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_bloodtype_users(): void
    {
        $bloodtype = Bloodtype::factory()->create();
        $data = User::factory()
            ->make([
                'bloodtype_id' => $bloodtype->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.bloodtypes.users.store', $bloodtype),
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

        $this->assertEquals($bloodtype->id, $user->bloodtype_id);
    }
}
