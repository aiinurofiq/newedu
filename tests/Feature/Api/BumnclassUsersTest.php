<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bumnclass;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BumnclassUsersTest extends TestCase
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
    public function it_gets_bumnclass_users(): void
    {
        $bumnclass = Bumnclass::factory()->create();
        $user = User::factory()->create();

        $bumnclass->users()->attach($user);

        $response = $this->getJson(
            route('api.bumnclasses.users.index', $bumnclass)
        );

        $response->assertOk()->assertSee($user->name);
    }

    /**
     * @test
     */
    public function it_can_attach_users_to_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.bumnclasses.users.store', [$bumnclass, $user])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $bumnclass
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_users_from_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();
        $user = User::factory()->create();

        $response = $this->deleteJson(
            route('api.bumnclasses.users.store', [$bumnclass, $user])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $bumnclass
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }
}
