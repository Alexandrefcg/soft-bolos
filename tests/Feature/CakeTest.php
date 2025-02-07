<?php

namespace Tests\Feature;

use App\Models\Cake;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CakeTest extends TestCase
{
    use RefreshDatabase;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->token = $response->json();
    }

    public function test_can_list_cakes()
    {
        Cake::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/cakes');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_can_create_cake()
    {
        $cakeData = [
            'name' => 'Chocolate Cake',
            'weight' => 500,
            'value' => 20.50,
            'quantity' => 10,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/cakes', $cakeData);

        $response->assertStatus(201)
                 ->assertJson([
                     'data' => $cakeData
                 ]);
    }
}