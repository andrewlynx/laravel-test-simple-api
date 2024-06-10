<?php

namespace Tests\TestData;

class SubmissionApiTestData
{
    public static $valid_data = [
        "name" => "John Doe",
        "email" => "john.doe@example.com",
        "message" => "This is a test message",
    ];

    public static $missing_property_data = [
        "name" => "John Doe",
        "email" => "john.doe@example.com",
    ];

    public static $invalid_email_data = [
        "name" => "John Doe",
        "email" => "john.doeexample.com",
        "message" => "This is a test message",
    ];

    public static $invalid_long_data = [
        "name" => "John Doe John Doe John Doe John Doe John Doe John Doe John Doe John Doe John Doe",
        "email" => "john.doe@example.com",
        "message" => "This is a test message",
    ];
}
