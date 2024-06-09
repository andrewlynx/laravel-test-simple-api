<?php

namespace App\Http\Controllers;

use App\DTO\SubmissionDTO;
use App\Http\Responses\ApiResponse;
use App\Jobs\ModelSaveJob;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function __construct(
        protected ModelSaveJob $saveJob,
    ) {}
    /**
     * Store a newly created resource in storage.
     */
    public function submit(Request $request)
    {
        $dto = SubmissionDTO::fromRequest($request);
        $this->saveJob->handle($dto);
        return new ApiResponse(200, ['Your request is being processed']);
    }
}
