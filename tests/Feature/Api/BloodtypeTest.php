<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bloodtype;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloodtypeTest extends TestCase
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
    public function it_gets_bloodtypes_list(): void
    {
        $bloodtypes = Bloodtype::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bloodtypes.index'));

        $response->assertOk()->assertSee($bloodtypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_bloodtype(): void
    {
        $data = Bloodtype::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bloodtypes.store'), $data);

        $this->assertDatabaseHas('bloodtypes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bloodtype(): void
    {
        $bloodtype = Bloodtype::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.bloodtypes.update', $bloodtype),
            $data
        );

        $data['id'] = $bloodtype->id;

        $this->assertDatabaseHas('bloodtypes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bloodtype(): void
    {
        $bloodtype = Bloodtype::factory()->create();

        $response = $this->deleteJson(
            route('api.bloodtypes.destroy', $bloodtype)
        );

        $this->assertModelMissing($bloodtype);

        $response->assertNoContent();
    }
}