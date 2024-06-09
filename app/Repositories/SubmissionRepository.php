<?php

namespace App\Repositories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Collection;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SubmissionRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return Submission::all();
    }

    public function create(ValidatedDTO $data): Submission
    {
        return Submission::create($data->toArray());
    }

    public function update(ValidatedDTO $data, $id): Submission
    {
        $user = Submission::findOrFail($id);
        $user->update($data->toArray());

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
