<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Position;
use App\Models\Fieldofposition;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldofpositionPositionsTest extends TestCase
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
    public function it_gets_fieldofposition_positions(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();
        $positions = Position::factory()
            ->count(2)
            ->create([
                'fieldofposition_id' => $fieldofposition->id,
            ]);

        $response = $this->getJson(
            route('api.fieldofpositions.positions.index', $fieldofposition)
        );

        $response->assertOk()->assertSee($positions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_fieldofposition_positions(): void
    {
        $fieldofposition = Fieldofposition::factory()->create();
        $data = Position::factory()
            ->make([
                'fieldofposition_id' => $fieldofposition->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.fieldofpositions.positions.store', $fieldofposition),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('positions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $position = Position::latest('id')->first();

        $this->assertEquals(
            $fieldofposition->id,
            $position->fieldofposition_id
        );
    }
}
