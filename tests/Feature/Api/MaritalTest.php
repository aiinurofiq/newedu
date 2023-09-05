<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Marital;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaritalTest extends TestCase
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
    public function it_gets_maritals_list(): void
    {
        $maritals = Marital::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.maritals.index'));

        $response->assertOk()->assertSee($maritals[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_marital(): void
    {
        $data = Marital::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.maritals.store'), $data);

        $this->assertDatabaseHas('maritals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_marital(): void
    {
        $marital = Marital::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.maritals.update', $marital),
            $data
        );

        $data['id'] = $marital->id;

        $this->assertDatabaseHas('maritals', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_marital(): void
    {
        $marital = Marital::factory()->create();

        $response = $this->deleteJson(route('api.maritals.destroy', $marital));

        $this->assertModelMissing($marital);

        $response->assertNoContent();
    }
}
