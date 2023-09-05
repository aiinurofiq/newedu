<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Organization;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserOrganizationsTest extends TestCase
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
    public function it_gets_user_organizations(): void
    {
        $user = User::factory()->create();
        $organizations = Organization::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.organizations.index', $user)
        );

        $response->assertOk()->assertSee($organizations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_organizations(): void
    {
        $user = User::factory()->create();
        $data = Organization::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.organizations.store', $user),
            $data
        );

        unset($data['user_id']);
        unset($data['status']);

        $this->assertDatabaseHas('organizations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $organization = Organization::latest('id')->first();

        $this->assertEquals($user->id, $organization->user_id);
    }
}
