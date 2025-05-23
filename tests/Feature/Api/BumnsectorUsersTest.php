<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bumnsector;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BumnsectorUsersTest extends TestCase
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
    public function it_gets_bumnsector_users(): void
    {
        $bumnsector = Bumnsector::factory()->create();
        $user = User::factory()->create();

        $bumnsector->users()->attach($user);

        $response = $this->getJson(
            route('api.bumnsectors.users.index', $bumnsector)
        );

        $response->assertOk()->assertSee($user->name);
    }

    /**
     * @test
     */
    public function it_can_attach_users_to_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.bumnsectors.users.store', [$bumnsector, $user])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $bumnsector
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_users_from_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();
        $user = User::factory()->create();

        $response = $this->deleteJson(
            route('api.bumnsectors.users.store', [$bumnsector, $user])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $bumnsector
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }
}
