<?php

namespace Tests\Feature;

use App\Models\Cake;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CakeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_cakes()
    {
        Cake::factory()->count(3)->create();

        $response = $this->getJson('/api/cakes');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_create_cake()
    {
        $cakeData = [
            'name' => 'Chocolate Cake',
            'weight' => 500,
            'value' => 20.50,
            'quantity' => 10,
        ];

        $response = $this->postJson('/api/cakes', $cakeData);

        $response->assertStatus(201)
                 ->assertJson($cakeData);
    }
}