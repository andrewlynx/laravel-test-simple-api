<?php

namespace App\Jobs;

use App\DTO\SubmissionDTO;
use App\Events\SubmissionJobSaved;
use App\Repositories\RepositoryInterface;
use App\Repositories\SubmissionRepository;
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
     * Execute the job.
     */
    public function handle(ValidatedDTO $dto): void
    {
        $this->repository = $this->getRepository($dto);
        $model = $this->repository->create($dto);
        event(new SubmissionJobSaved($model));
    }

    private function getRepository(ValidatedDTO $dto): RepositoryInterface
    {
        return match ($dto::class) {
            SubmissionDTO::class => new SubmissionRepository(),
        };
    }
}
