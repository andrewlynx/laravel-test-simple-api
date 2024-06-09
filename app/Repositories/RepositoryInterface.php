<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

interface RepositoryInterface
{
    public function all(): Collection;

    public function create(ValidatedDTO $data): Model;

    public function update(ValidatedDTO $data, $id): Model;

    public function delete($id);

    public function find($id): Model;
}
