<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

/**
 * @property string $name
 * @property string $email
 * @property string $message
 */
class SubmissionDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:64'],
            'email'    => ['required', 'email'],
            'message'  => ['required', 'string', 'max:64'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
