<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\University;
use App\Models\Eduhistory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityEduhistoriesTest extends TestCase
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
    public function it_gets_university_eduhistories(): void
    {
        $university = University::factory()->create();
        $eduhistories = Eduhistory::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.eduhistories.index', $university)
        );

        $response->assertOk()->assertSee($eduhistories[0]->major);
    }

    /**
     * @test
     */
    public function it_stores_the_university_eduhistories(): void
    {
        $university = University::factory()->create();
        $data = Eduhistory::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.eduhistories.store', $university),
            $data
        );

        unset($data['academic_degree']);
        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('eduhistories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $eduhistory = Eduhistory::latest('id')->first();

        $this->assertEquals($university->id, $eduhistory->university_id);
    }
}
