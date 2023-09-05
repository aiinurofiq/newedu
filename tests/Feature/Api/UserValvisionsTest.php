<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Valvision;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserValvisionsTest extends TestCase
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
    public function it_gets_user_valvisions(): void
    {
        $user = User::factory()->create();
        $valvisions = Valvision::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.valvisions.index', $user));

        $response->assertOk()->assertSee($valvisions[0]->value);
    }

    /**
     * @test
     */
    public function it_stores_the_user_valvisions(): void
    {
        $user = User::factory()->create();
        $data = Valvision::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.valvisions.store', $user),
            $data
        );

        unset($data['user_id']);

        $this->assertDatabaseHas('valvisions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $valvision = Valvision::latest('id')->first();

        $this->assertEquals($user->id, $valvision->user_id);
    }
}
