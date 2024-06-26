<?php

namespace Tests\Unit;

use App\DTO\SubmissionDTO;
use App\Events\SubmissionJobSaved;
use App\Jobs\ModelSaveJob;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Tests\TestData\SubmissionApiTestData;


class ApiTest extends TestCase
{
    public function test_missing_field(): void
    {
        $this->expectExceptionMessage('The message field is required.');
        SubmissionDTO::fromArray(SubmissionApiTestData::$missing_property_data);
    }

    public function test_invalid_email(): void
    {
        $this->expectExceptionMessage('The email field must be a valid email address.');
        SubmissionDTO::fromArray(SubmissionApiTestData::$invalid_email_data);
    }

    public function test_invalid_long_data(): void
    {
        $this->expectExceptionMessage('The name field must not be greater than 64 characters');
        SubmissionDTO::fromArray(SubmissionApiTestData::$invalid_long_data);
    }

    public function test_valid_data(): void
    {
        $dto = SubmissionDTO::fromArray(SubmissionApiTestData::$valid_data);
        $this->assertSame($dto->toArray(), SubmissionApiTestData::$valid_data);
    }

    public function test_event_handle(): void
    {
        Event::fake();

        $dto = SubmissionDTO::fromArray(SubmissionApiTestData::$valid_data);
        $job = new ModelSaveJob();
        $job->handle($dto);

        Event::assertDispatched(SubmissionJobSaved::class, function (SubmissionJobSaved $event){
            $this->assertEquals(SubmissionApiTestData::$valid_data['email'], $event->submission->email);
            return true;
        });
    }
}
