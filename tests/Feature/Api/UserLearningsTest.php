<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Learning;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLearningsTest extends TestCase
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
    public function it_gets_user_learnings(): void
    {
        $user = User::factory()->create();
        $learnings = Learning::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.learnings.index', $user));

        $response->assertOk()->assertSee($learnings[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_user_learnings(): void
    {
        $user = User::factory()->create();
        $data = Learning::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.learnings.store', $user),
            $data
        );

        unset($data['title']);
        unset($data['image']);
        unset($data['description']);
        unset($data['type']);
        unset($data['price']);
        unset($data['user_id']);
        unset($data['categorylearn_id']);
        unset($data['level']);
        unset($data['ispublic']);

        $this->assertDatabaseHas('learnings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $learning = Learning::latest('id')->first();

        $this->assertEquals($user->id, $learning->user_id);
    }
}
