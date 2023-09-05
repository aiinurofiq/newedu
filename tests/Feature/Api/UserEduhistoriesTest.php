<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Eduhistory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEduhistoriesTest extends TestCase
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
    public function it_gets_user_eduhistories(): void
    {
        $user = User::factory()->create();
        $eduhistories = Eduhistory::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.eduhistories.index', $user)
        );

        $response->assertOk()->assertSee($eduhistories[0]->major);
    }

    /**
     * @test
     */
    public function it_stores_the_user_eduhistories(): void
    {
        $user = User::factory()->create();
        $data = Eduhistory::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.eduhistories.store', $user),
            $data
        );

        unset($data['academic_degree']);
        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('eduhistories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $eduhistory = Eduhistory::latest('id')->first();

        $this->assertEquals($user->id, $eduhistory->user_id);
    }
}
