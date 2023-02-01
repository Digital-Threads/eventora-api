<?php

namespace Infrastructure\Auth;

final class CheckResponse
{
    public function __construct(
        public readonly bool $allow,
        public readonly CheckFailure $failure = new CheckFailure(),
    ) {
        //
    }

    public static function allowed(): static
    {
        return new static(true);
    }

    public static function denied(): static
    {
        return new static(false);
    }

    public function authorize(): void
    {
        if ($this->allow) {
            return;
        }

        throw $this->failure->toException();
    }
}
