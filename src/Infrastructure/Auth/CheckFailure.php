<?php

namespace Infrastructure\Auth;

use Exception;

final readonly class CheckFailure
{
    public function __construct(
        public string $error = 'forbidden',
        public ?string $errorDescription = null,
        public ?string $message = null,
        public ?string $hint = null,
    ) {
        //
    }

    public static function create(
        Check $check,
        ?string $errorDescription = null,
        ?string $message = null,
        ?string $hint = null,
    ): static {
        $base = str($check::class)
            ->classBasename()
            ->snake()
            ->beforeLast('_check');

        return new static(
            $base->toString(),
            $base
                ->append('.')
                ->append($errorDescription ?? 'error_description')
                ->toString(),
            $base
                ->append('.')
                ->append($message ?? 'message')
                ->toString(),
            $base
                ->append('.')
                ->append($hint ?? 'hint')
                ->toString(),
        );
    }

    public function toException(): Exception
    {
        return new CheckException($this);
    }
}
