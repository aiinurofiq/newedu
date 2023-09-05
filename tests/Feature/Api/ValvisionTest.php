<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Valvision;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValvisionTest extends TestCase
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
    public function it_gets_valvisions_list(): void
    {
        $valvisions = Valvision::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.valvisions.index'));

        $response->assertOk()->assertSee($valvisions[0]->value);
    }

    /**
     * @test
     */
    public function it_stores_the_valvision(): void
    {
        $data = Valvision::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.valvisions.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('valvisions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_valvision(): void
    {
        $valvision = Valvision::factory()->create();

        $user = User::factory()->create();

        $data = [
            'value' => $this->faker->text(255),
            'vision' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.valvisions.update', $valvision),
            $data
        );

        unset($data['user_id']);

        $data['id'] = $valvision->id;

        $this->assertDatabaseHas('valvisions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_valvision(): void
    {
        $valvision = Valvision::factory()->create();

        $response = $this->deleteJson(
            route('api.valvisions.destroy', $valvision)
        );

        $this->assertModelMissing($valvision);

        $response->assertNoContent();
    }
}
