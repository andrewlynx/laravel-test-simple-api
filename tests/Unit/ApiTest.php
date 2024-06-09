<?php

namespace Tests\Unit;

use App\DTO\SubmissionDTO;
use Tests\TestCase;


class ApiTest extends TestCase
{
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

    private $invalid_long_data = [
        "name" => "John Doe John Doe John Doe John Doe John Doe John Doe John Doe John Doe John Doe",
        "email" => "john.doe@example.com",
        "message" => "This is a test message",
    ];

    public function test_missing_field(): void
    {
        $this->expectExceptionMessage('The message field is required.');
        SubmissionDTO::fromArray($this->missing_property_data);
    }

    public function test_invalid_email(): void
    {
        $this->expectExceptionMessage('The email field must be a valid email address.');
        SubmissionDTO::fromArray($this->invalid_email_data);
    }

    public function test_invalid_long_data(): void
    {
        $this->expectExceptionMessage('The name field must not be greater than 64 characters');
        SubmissionDTO::fromArray($this->invalid_long_data);
    }

    public function test_valid_data(): void
    {
        $dto = SubmissionDTO::fromArray($this->valid_data);
        $this->assertSame($dto->toArray(), $this->valid_data);
    }
}
