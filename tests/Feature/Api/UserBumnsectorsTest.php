<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bumnsector;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBumnsectorsTest extends TestCase
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
    public function it_gets_user_bumnsectors(): void
    {
        $user = User::factory()->create();
        $bumnsector = Bumnsector::factory()->create();

        $user->bumnsectors()->attach($bumnsector);

        $response = $this->getJson(route('api.users.bumnsectors.index', $user));

        $response->assertOk()->assertSee($bumnsector->name);
    }

    /**
     * @test
     */
    public function it_can_attach_bumnsectors_to_user(): void
    {
        $user = User::factory()->create();
        $bumnsector = Bumnsector::factory()->create();

        $response = $this->postJson(
            route('api.users.bumnsectors.store', [$user, $bumnsector])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $user
                ->bumnsectors()
                ->where('bumnsectors.id', $bumnsector->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_bumnsectors_from_user(): void
    {
        $user = User::factory()->create();
        $bumnsector = Bumnsector::factory()->create();

        $response = $this->deleteJson(
            route('api.users.bumnsectors.store', [$user, $bumnsector])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $user
                ->bumnsectors()
                ->where('bumnsectors.id', $bumnsector->id)
                ->exists()
        );
    }
}
