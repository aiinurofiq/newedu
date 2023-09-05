<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Reqknowledge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserReqknowledgesTest extends TestCase
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
    public function it_gets_user_reqknowledges(): void
    {
        $user = User::factory()->create();
        $reqknowledges = Reqknowledge::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.reqknowledges.index', $user)
        );

        $response->assertOk()->assertSee($reqknowledges[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_user_reqknowledges(): void
    {
        $user = User::factory()->create();
        $data = Reqknowledge::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.reqknowledges.store', $user),
            $data
        );

        unset($data['description']);
        unset($data['explanation_id']);
        unset($data['exsum_id']);
        unset($data['report_id']);
        unset($data['jurnal_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('reqknowledges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $reqknowledge = Reqknowledge::latest('id')->first();

        $this->assertEquals($user->id, $reqknowledge->user_id);
    }
}
