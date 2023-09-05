<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Division;
use App\Models\Position;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DivisionPositionsTest extends TestCase
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
    public function it_gets_division_positions(): void
    {
        $division = Division::factory()->create();
        $positions = Position::factory()
            ->count(2)
            ->create([
                'division_id' => $division->id,
            ]);

        $response = $this->getJson(
            route('api.divisions.positions.index', $division)
        );

        $response->assertOk()->assertSee($positions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_division_positions(): void
    {
        $division = Division::factory()->create();
        $data = Position::factory()
            ->make([
                'division_id' => $division->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.divisions.positions.store', $division),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('positions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $position = Position::latest('id')->first();

        $this->assertEquals($division->id, $position->division_id);
    }
}
