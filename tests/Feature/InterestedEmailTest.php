<?php

namespace Tests\Feature;

use App\Models\Cake;
use App\Models\InterestedEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestedEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_interested_email()
    {
        $cake = Cake::factory()->create();

        $emailData = [
            'email' => 'test@example.com',
            'cake_id' => $cake->id,
        ];

        $response = $this->postJson('/api/interested-emails', $emailData);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Email registered successfully']);
    }
}