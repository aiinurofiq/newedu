<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Wifhus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserWifhusesTest extends TestCase
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
    public function it_gets_user_wifhuses(): void
    {
        $user = User::factory()->create();
        $wifhuses = Wifhus::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.wifhuses.index', $user));

        $response->assertOk()->assertSee($wifhuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_wifhuses(): void
    {
        $user = User::factory()->create();
        $data = Wifhus::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.wifhuses.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('wifhuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $wifhus = Wifhus::latest('id')->first();

        $this->assertEquals($user->id, $wifhus->user_id);
    }
}
