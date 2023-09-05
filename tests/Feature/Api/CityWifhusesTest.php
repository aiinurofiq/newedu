<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Wifhus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityWifhusesTest extends TestCase
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
    public function it_gets_city_wifhuses(): void
    {
        $city = City::factory()->create();
        $wifhuses = Wifhus::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(route('api.cities.wifhuses.index', $city));

        $response->assertOk()->assertSee($wifhuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_city_wifhuses(): void
    {
        $city = City::factory()->create();
        $data = Wifhus::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.wifhuses.store', $city),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('wifhuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $wifhus = Wifhus::latest('id')->first();

        $this->assertEquals($city->id, $wifhus->city_id);
    }
}
