<?php

namespace Tests\Feature\Api;

use App\Models\Kid;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserKidsTest extends TestCase
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
    public function it_gets_user_kids(): void
    {
        $user = User::factory()->create();
        $kids = Kid::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.kids.index', $user));

        $response->assertOk()->assertSee($kids[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_kids(): void
    {
        $user = User::factory()->create();
        $data = Kid::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.kids.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('kids', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $kid = Kid::latest('id')->first();

        $this->assertEquals($user->id, $kid->user_id);
    }
}
