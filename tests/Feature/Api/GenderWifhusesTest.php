<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Gender;
use App\Models\Wifhus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenderWifhusesTest extends TestCase
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
    public function it_gets_gender_wifhuses(): void
    {
        $gender = Gender::factory()->create();
        $wifhuses = Wifhus::factory()
            ->count(2)
            ->create([
                'gender_id' => $gender->id,
            ]);

        $response = $this->getJson(
            route('api.genders.wifhuses.index', $gender)
        );

        $response->assertOk()->assertSee($wifhuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_gender_wifhuses(): void
    {
        $gender = Gender::factory()->create();
        $data = Wifhus::factory()
            ->make([
                'gender_id' => $gender->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.genders.wifhuses.store', $gender),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('wifhuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $wifhus = Wifhus::latest('id')->first();

        $this->assertEquals($gender->id, $wifhus->gender_id);
    }
}
