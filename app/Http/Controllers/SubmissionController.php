<?php

namespace App\Http\Controllers;

use App\DTO\SubmissionDTO;
use App\Http\Requests\SubmissionRequest;
use App\Http\Responses\ApiResponse;
use App\Jobs\ModelSaveJob;

class SubmissionController extends Controller
{
    public function __construct(
        protected ModelSaveJob $saveJob,
    ) {}
    /**
     * Store a newly created resource in storage.
     */
    public function submit(SubmissionRequest $request)
    {
        $dto = SubmissionDTO::fromRequest($request);
        $this->saveJob->handle($dto);
        return new ApiResponse(200, ['Your request is being processed']);
    }
}
