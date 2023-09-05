<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Knowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserKnowledgesTest extends TestCase
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
    public function it_gets_user_knowledges(): void
    {
        $user = User::factory()->create();
        $knowledges = Knowledge::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.knowledges.index', $user));

        $response->assertOk()->assertSee($knowledges[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_user_knowledges(): void
    {
        $user = User::factory()->create();
        $data = Knowledge::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.knowledges.store', $user),
            $data
        );

        $this->assertDatabaseHas('knowledges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $knowledge = Knowledge::latest('id')->first();

        $this->assertEquals($user->id, $knowledge->user_id);
    }
}
