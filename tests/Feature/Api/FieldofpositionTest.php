<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Fieldofposition;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldofpositionTest extends TestCase
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
    public function it_gets_fieldofpositions_list(): void
    {
        $fieldofpositions = Fieldofposition::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.fieldofpositions.index'));

        $response->assertOk()->assertSee($fieldofpositions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_fieldofposition(): void
    {
        $data = Fieldofposition::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.fieldofpositions.store'), $data);

        $this->assertDatabaseHas('fieldofpositions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_fieldofposition(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.fieldofpositions.update', $fieldofposition),
            $data
        );

        $data['id'] = $fieldofposition->id;

        $this->assertDatabaseHas('fieldofpositions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_fieldofposition(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();

        $response = $this->deleteJson(
            route('api.fieldofpositions.destroy', $fieldofposition)
        );

        $this->assertModelMissing($fieldofposition);

        $response->assertNoContent();
    }
}
