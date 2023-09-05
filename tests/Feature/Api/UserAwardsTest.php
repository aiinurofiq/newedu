<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Award;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAwardsTest extends TestCase
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
    public function it_gets_user_awards(): void
    {
        $user = User::factory()->create();
        $awards = Award::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.awards.index', $user));

        $response->assertOk()->assertSee($awards[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_awards(): void
    {
        $user = User::factory()->create();
        $data = Award::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.awards.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('awards', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $award = Award::latest('id')->first();

        $this->assertEquals($user->id, $award->user_id);
    }
}
