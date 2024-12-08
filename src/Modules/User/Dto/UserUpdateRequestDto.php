<?php

namespace Modules\User\Dto;

final readonly class UserUpdateRequestDto
{
    /**
     */
    public function __construct(
        public string $firstName,
        public string $lastName,
        public ?int $roleId,
    ) {
    }

    public function toArray(): array
    {
        array_filter( [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'role_id' => $this->roleId??null,
        ], fn($value) => !is_null($value));
    }
}
