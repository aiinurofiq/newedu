<?php

namespace Tests\Feature\Api;

use App\Models\Kid;
use App\Models\User;
use App\Models\Gender;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenderKidsTest extends TestCase
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
    public function it_gets_gender_kids(): void
    {
        $gender = Gender::factory()->create();
        $kids = Kid::factory()
            ->count(2)
            ->create([
                'gender_id' => $gender->id,
            ]);

        $response = $this->getJson(route('api.genders.kids.index', $gender));

        $response->assertOk()->assertSee($kids[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_gender_kids(): void
    {
        $gender = Gender::factory()->create();
        $data = Kid::factory()
            ->make([
                'gender_id' => $gender->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.genders.kids.store', $gender),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('kids', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $kid = Kid::latest('id')->first();

        $this->assertEquals($gender->id, $kid->gender_id);
    }
}
