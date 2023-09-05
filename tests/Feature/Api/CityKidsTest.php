<?php

namespace Tests\Feature\Api;

use App\Models\Kid;
use App\Models\User;
use App\Models\City;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityKidsTest extends TestCase
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
    public function it_gets_city_kids(): void
    {
        $city = City::factory()->create();
        $kids = Kid::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(route('api.cities.kids.index', $city));

        $response->assertOk()->assertSee($kids[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_city_kids(): void
    {
        $city = City::factory()->create();
        $data = Kid::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.kids.store', $city),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('kids', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $kid = Kid::latest('id')->first();

        $this->assertEquals($city->id, $kid->city_id);
    }
}
