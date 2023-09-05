<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bumnsector;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BumnsectorTest extends TestCase
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
    public function it_gets_bumnsectors_list(): void
    {
        $bumnsectors = Bumnsector::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bumnsectors.index'));

        $response->assertOk()->assertSee($bumnsectors[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_bumnsector(): void
    {
        $data = Bumnsector::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bumnsectors.store'), $data);

        $this->assertDatabaseHas('bumnsectors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.bumnsectors.update', $bumnsector),
            $data
        );

        $data['id'] = $bumnsector->id;

        $this->assertDatabaseHas('bumnsectors', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bumnsector(): void
    {
        $bumnsector = Bumnsector::factory()->create();

        $response = $this->deleteJson(
            route('api.bumnsectors.destroy', $bumnsector)
        );

        $this->assertModelMissing($bumnsector);

        $response->assertNoContent();
    }
}
