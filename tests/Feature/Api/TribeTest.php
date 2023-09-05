<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Tribe;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TribeTest extends TestCase
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
    public function it_gets_tribes_list(): void
    {
        $tribes = Tribe::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tribes.index'));

        $response->assertOk()->assertSee($tribes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_tribe(): void
    {
        $data = Tribe::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tribes.store'), $data);

        $this->assertDatabaseHas('tribes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_tribe(): void
    {
        $tribe = Tribe::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('api.tribes.update', $tribe), $data);

        $data['id'] = $tribe->id;

        $this->assertDatabaseHas('tribes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tribe(): void
    {
        $tribe = Tribe::factory()->create();

        $response = $this->deleteJson(route('api.tribes.destroy', $tribe));

        $this->assertModelMissing($tribe);

        $response->assertNoContent();
    }
}
