<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bumnclass;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBumnclassesTest extends TestCase
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
    public function it_gets_user_bumnclasses(): void
    {
        $user = User::factory()->create();
        $bumnclass = Bumnclass::factory()->create();

        $user->bumnclasses()->attach($bumnclass);

        $response = $this->getJson(route('api.users.bumnclasses.index', $user));

        $response->assertOk()->assertSee($bumnclass->name);
    }

    /**
     * @test
     */
    public function it_can_attach_bumnclasses_to_user(): void
    {
        $user = User::factory()->create();
        $bumnclass = Bumnclass::factory()->create();

        $response = $this->postJson(
            route('api.users.bumnclasses.store', [$user, $bumnclass])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $user
                ->bumnclasses()
                ->where('bumnclasses.id', $bumnclass->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_bumnclasses_from_user(): void
    {
        $user = User::factory()->create();
        $bumnclass = Bumnclass::factory()->create();

        $response = $this->deleteJson(
            route('api.users.bumnclasses.store', [$user, $bumnclass])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $user
                ->bumnclasses()
                ->where('bumnclasses.id', $bumnclass->id)
                ->exists()
        );
    }
}
