<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Eduhistory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityEduhistoriesTest extends TestCase
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
    public function it_gets_city_eduhistories(): void
    {
        $city = City::factory()->create();
        $eduhistories = Eduhistory::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(
            route('api.cities.eduhistories.index', $city)
        );

        $response->assertOk()->assertSee($eduhistories[0]->major);
    }

    /**
     * @test
     */
    public function it_stores_the_city_eduhistories(): void
    {
        $city = City::factory()->create();
        $data = Eduhistory::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.eduhistories.store', $city),
            $data
        );

        unset($data['academic_degree']);
        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('eduhistories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $eduhistory = Eduhistory::latest('id')->first();

        $this->assertEquals($city->id, $eduhistory->city_id);
    }
}
