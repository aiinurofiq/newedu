<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Tribe;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TribeControllerTest extends TestCase
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
    public function it_displays_index_view_with_tribes(): void
    {
        $tribes = Tribe::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tribes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tribes.index')
            ->assertViewHas('tribes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tribe(): void
    {
        $response = $this->get(route('tribes.create'));

        $response->assertOk()->assertViewIs('app.tribes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tribe(): void
    {
        $data = Tribe::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tribes.store'), $data);

        $this->assertDatabaseHas('tribes', $data);

        $tribe = Tribe::latest('id')->first();

        $response->assertRedirect(route('tribes.edit', $tribe));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tribe(): void
    {
        $tribe = Tribe::factory()->create();

        $response = $this->get(route('tribes.show', $tribe));

        $response
            ->assertOk()
            ->assertViewIs('app.tribes.show')
            ->assertViewHas('tribe');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tribe(): void
    {
        $tribe = Tribe::factory()->create();

        $response = $this->get(route('tribes.edit', $tribe));

        $response
            ->assertOk()
            ->assertViewIs('app.tribes.edit')
            ->assertViewHas('tribe');
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

        $response = $this->put(route('tribes.update', $tribe), $data);

        $data['id'] = $tribe->id;

        $this->assertDatabaseHas('tribes', $data);

        $response->assertRedirect(route('tribes.edit', $tribe));
    }

    /**
     * @test
     */
    public function it_deletes_the_tribe(): void
    {
        $tribe = Tribe::factory()->create();

        $response = $this->delete(route('tribes.destroy', $tribe));

        $response->assertRedirect(route('tribes.index'));

        $this->assertModelMissing($tribe);
    }
}
