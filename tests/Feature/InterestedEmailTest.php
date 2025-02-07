<?php

namespace Tests\Feature;

use App\Models\Cake;
use App\Models\InterestedEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestedEmailTest extends TestCase
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

    public function test_can_register_interested_email()
    {
        $cake = Cake::factory()->create();

        $emailData = [
            'email' => 'interessado@example.com',
            'cake_id' => $cake->id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/interested-emails', $emailData);

        $response->assertStatus(201)
                ->assertJson(['message' => 'E-mail registrado com sucesso!']);
    }
}