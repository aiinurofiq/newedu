<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Position;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPositionsTest extends TestCase
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
    public function it_gets_user_positions(): void
    {
        $user = User::factory()->create();
        $positions = Position::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.positions.index', $user));

        $response->assertOk()->assertSee($positions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_positions(): void
    {
        $user = User::factory()->create();
        $data = Position::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.positions.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('positions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $position = Position::latest('id')->first();

        $this->assertEquals($user->id, $position->user_id);
    }
}
