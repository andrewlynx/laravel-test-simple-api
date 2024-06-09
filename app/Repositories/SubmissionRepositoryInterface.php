<?php

namespace App\Repositories;

use App\DTO\SubmissionDTO;

interface SubmissionRepositoryInterface
{
    public function all();

    public function create(SubmissionDTO $data);

    public function update(SubmissionDTO $data, $id);

    public function delete($id);

    public function find($id);
}
