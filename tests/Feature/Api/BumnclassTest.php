<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bumnclass;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BumnclassTest extends TestCase
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
    public function it_gets_bumnclasses_list(): void
    {
        $bumnclasses = Bumnclass::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bumnclasses.index'));

        $response->assertOk()->assertSee($bumnclasses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_bumnclass(): void
    {
        $data = Bumnclass::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bumnclasses.store'), $data);

        $this->assertDatabaseHas('bumnclasses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.bumnclasses.update', $bumnclass),
            $data
        );

        $data['id'] = $bumnclass->id;

        $this->assertDatabaseHas('bumnclasses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bumnclass(): void
    {
        $bumnclass = Bumnclass::factory()->create();

        $response = $this->deleteJson(
            route('api.bumnclasses.destroy', $bumnclass)
        );

        $this->assertModelMissing($bumnclass);

        $response->assertNoContent();
    }
}
