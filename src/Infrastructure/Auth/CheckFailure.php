<?php

namespace Infrastructure\Auth;

use Exception;

final class CheckFailure
{
    public function __construct(
        public readonly string $error = 'forbidden',
        public readonly ?string $errorDescription = null,
        public readonly ?string $message = null,
        public readonly ?string $hint = null,
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
