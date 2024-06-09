<?php

namespace App\Repositories;

use App\DTO\SubmissionDTO;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Collection;

class SubmissionRepository implements SubmissionRepositoryInterface
{
    public function all(): Collection
    {
        return Submission::all();
    }

    public function create(SubmissionDTO $data): Submission
    {
        return Submission::create($data);
    }

    public function update(SubmissionDTO $data, $id): Submission
    {
        $user = Submission::findOrFail($id);
        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = Submission::findOrFail($id);
        $user->delete();
    }

    public function find($id): Submission
    {
        return Submission::findOrFail($id);
    }
}
