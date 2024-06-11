<?php

namespace Tests\Feature;

use App\Events\SubmissionJobSaved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Tests\TestData\SubmissionApiTestData;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_event_handle(): void
    {
        Event::fake();

        $this->postJson('/api/submit', SubmissionApiTestData::$valid_data);

        Event::assertDispatched(SubmissionJobSaved::class, function (SubmissionJobSaved $event){
            $this->assertEquals(SubmissionApiTestData::$valid_data['email'], $event->submission->email);
            return true;
        });
    }
}
