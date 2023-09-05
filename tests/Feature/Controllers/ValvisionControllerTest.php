<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Valvision;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValvisionControllerTest extends TestCase
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
    public function it_displays_index_view_with_valvisions(): void
    {
        $valvisions = Valvision::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('valvisions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.valvisions.index')
            ->assertViewHas('valvisions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_valvision(): void
    {
        $response = $this->get(route('valvisions.create'));

        $response->assertOk()->assertViewIs('app.valvisions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_valvision(): void
    {
        $data = Valvision::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('valvisions.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('valvisions', $data);

        $valvision = Valvision::latest('id')->first();

        $response->assertRedirect(route('valvisions.edit', $valvision));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_valvision(): void
    {
        $valvision = Valvision::factory()->create();

        $response = $this->get(route('valvisions.show', $valvision));

        $response
            ->assertOk()
            ->assertViewIs('app.valvisions.show')
            ->assertViewHas('valvision');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_valvision(): void
    {
        $valvision = Valvision::factory()->create();

        $response = $this->get(route('valvisions.edit', $valvision));

        $response
            ->assertOk()
            ->assertViewIs('app.valvisions.edit')
            ->assertViewHas('valvision');
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

        $response = $this->put(route('valvisions.update', $valvision), $data);

        unset($data['user_id']);

        $data['id'] = $valvision->id;

        $this->assertDatabaseHas('valvisions', $data);

        $response->assertRedirect(route('valvisions.edit', $valvision));
    }

    /**
     * @test
     */
    public function it_deletes_the_valvision(): void
    {
        $valvision = Valvision::factory()->create();

        $response = $this->delete(route('valvisions.destroy', $valvision));

        $response->assertRedirect(route('valvisions.index'));

        $this->assertModelMissing($valvision);
    }
}
