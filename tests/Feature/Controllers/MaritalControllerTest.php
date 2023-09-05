<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Marital;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaritalControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_maritals(): void
    {
        $maritals = Marital::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('maritals.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.maritals.index')
            ->assertViewHas('maritals');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_marital(): void
    {
        $response = $this->get(route('maritals.create'));

        $response->assertOk()->assertViewIs('app.maritals.create');
    }

    /**
     * @test
     */
    public function it_stores_the_marital(): void
    {
        $data = Marital::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('maritals.store'), $data);

        $this->assertDatabaseHas('maritals', $data);

        $marital = Marital::latest('id')->first();

        $response->assertRedirect(route('maritals.edit', $marital));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_marital(): void
    {
        $marital = Marital::factory()->create();

        $response = $this->get(route('maritals.show', $marital));

        $response
            ->assertOk()
            ->assertViewIs('app.maritals.show')
            ->assertViewHas('marital');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_marital(): void
    {
        $marital = Marital::factory()->create();

        $response = $this->get(route('maritals.edit', $marital));

        $response
            ->assertOk()
            ->assertViewIs('app.maritals.edit')
            ->assertViewHas('marital');
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

        $response = $this->put(route('maritals.update', $marital), $data);

        $data['id'] = $marital->id;

        $this->assertDatabaseHas('maritals', $data);

        $response->assertRedirect(route('maritals.edit', $marital));
    }

    /**
     * @test
     */
    public function it_deletes_the_marital(): void
    {
        $marital = Marital::factory()->create();

        $response = $this->delete(route('maritals.destroy', $marital));

        $response->assertRedirect(route('maritals.index'));

        $this->assertModelMissing($marital);
    }
}
