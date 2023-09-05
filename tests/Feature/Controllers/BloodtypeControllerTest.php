<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Bloodtype;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloodtypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_bloodtypes(): void
    {
        $bloodtypes = Bloodtype::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bloodtypes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bloodtypes.index')
            ->assertViewHas('bloodtypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bloodtype(): void
    {
        $response = $this->get(route('bloodtypes.create'));

        $response->assertOk()->assertViewIs('app.bloodtypes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bloodtype(): void
    {
        $data = Bloodtype::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bloodtypes.store'), $data);

        $this->assertDatabaseHas('bloodtypes', $data);

        $bloodtype = Bloodtype::latest('id')->first();

        $response->assertRedirect(route('bloodtypes.edit', $bloodtype));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bloodtype(): void
    {
        $bloodtype = Bloodtype::factory()->create();

        $response = $this->get(route('bloodtypes.show', $bloodtype));

        $response
            ->assertOk()
            ->assertViewIs('app.bloodtypes.show')
            ->assertViewHas('bloodtype');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bloodtype(): void
    {
        $bloodtype = Bloodtype::factory()->create();

        $response = $this->get(route('bloodtypes.edit', $bloodtype));

        $response
            ->assertOk()
            ->assertViewIs('app.bloodtypes.edit')
            ->assertViewHas('bloodtype');
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

        $response = $this->put(route('bloodtypes.update', $bloodtype), $data);

        $data['id'] = $bloodtype->id;

        $this->assertDatabaseHas('bloodtypes', $data);

        $response->assertRedirect(route('bloodtypes.edit', $bloodtype));
    }

    /**
     * @test
     */
    public function it_deletes_the_bloodtype(): void
    {
        $bloodtype = Bloodtype::factory()->create();

        $response = $this->delete(route('bloodtypes.destroy', $bloodtype));

        $response->assertRedirect(route('bloodtypes.index'));

        $this->assertModelMissing($bloodtype);
    }
}
