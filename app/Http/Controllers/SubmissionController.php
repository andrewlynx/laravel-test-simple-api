<?php

namespace App\Http\Controllers;

use App\DTO\SubmissionDTO;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function submit(Request $request)
    {
        $dto = SubmissionDTO::fromRequest($request);
    }
}
