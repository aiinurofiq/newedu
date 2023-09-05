<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Speaker;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSpeakersTest extends TestCase
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
    public function it_gets_user_speakers(): void
    {
        $user = User::factory()->create();
        $speakers = Speaker::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.speakers.index', $user));

        $response->assertOk()->assertSee($speakers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_speakers(): void
    {
        $user = User::factory()->create();
        $data = Speaker::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.speakers.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('speakers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $speaker = Speaker::latest('id')->first();

        $this->assertEquals($user->id, $speaker->user_id);
    }
}
