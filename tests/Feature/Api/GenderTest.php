<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Gender;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenderTest extends TestCase
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
    public function it_gets_genders_list(): void
    {
        $genders = Gender::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.genders.index'));

        $response->assertOk()->assertSee($genders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_gender(): void
    {
        $data = Gender::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.genders.store'), $data);

        $this->assertDatabaseHas('genders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_gender(): void
    {
        $gender = Gender::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('api.genders.update', $gender), $data);

        $data['id'] = $gender->id;

        $this->assertDatabaseHas('genders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_gender(): void
    {
        $gender = Gender::factory()->create();

        $response = $this->deleteJson(route('api.genders.destroy', $gender));

        $this->assertModelMissing($gender);

        $response->assertNoContent();
    }
}
