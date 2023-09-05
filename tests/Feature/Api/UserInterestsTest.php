<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Interest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserInterestsTest extends TestCase
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
    public function it_gets_user_interests(): void
    {
        $user = User::factory()->create();
        $interests = Interest::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.interests.index', $user));

        $response->assertOk()->assertSee($interests[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_user_interests(): void
    {
        $user = User::factory()->create();
        $data = Interest::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.interests.store', $user),
            $data
        );

        unset($data['description']);
        unset($data['user_id']);

        $this->assertDatabaseHas('interests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $interest = Interest::latest('id')->first();

        $this->assertEquals($user->id, $interest->user_id);
    }
}
