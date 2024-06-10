<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Tests\TestData\SubmissionApiTestData;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    private $valid_data = [
        "name" => "John Doe",
        "email" => "john.doe@example.com",
        "message" => "This is a test message",
    ];

    private $missing_property_data = [
        "name" => "John Doe",
        "email" => "john.doe@example.com",
    ];

    private $invalid_email_data = [
        "name" => "John Doe",
        "email" => "john.doeexample.com",
        "message" => "This is a test message",
    ];

    public function test_valid(): void
    {
        $response = $this->postJson('/api/submit', SubmissionApiTestData::$valid_data);
        $response->assertStatus(200);

        Log::shouldReceive('info')
            ->with('Submission saved successfully. Name: John Doe; Email: john.doe@example.com');

        $this->assertDatabaseHas('submissions', [
            'email' => 'john.doe@example.com',
        ]);
        $this->assertDatabaseCount('submissions', 1);
    }

    public function test_missing_property(): void
    {
        $response = $this->postJson('/api/submit', SubmissionApiTestData::$missing_property_data);
        $response->assertStatus(422);

        Log::shouldReceive('error')
            ->with('The name field is required');
        $this->assertDatabaseCount('submissions', 0);
    }

    public function test_invalid_email(): void
    {
        $response = $this->postJson('/api/submit', SubmissionApiTestData::$invalid_email_data);
        $response->assertStatus(422);

        Log::shouldReceive('error')
            ->with('The email field must be a valid email address.');
        $this->assertDatabaseCount('submissions', 0);
    }
}
