<?php

namespace App\Jobs;

use App\Events\SubmissionJobSaved;
use App\Repositories\RepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ModelSaveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected RepositoryInterface $repository;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->repository = \App::get(RepositoryInterface::class);
    }

    /**
     * Execute the job.
     */
    public function handle(ValidatedDTO $dto): void
    {
        $submission = $this->repository->create($dto);
        event(new SubmissionJobSaved($submission));
    }
}
