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

    public static function allowed(): CheckResponse
    {
        return new CheckResponse(true);
    }

    public static function denied(): CheckResponse
    {
        return new CheckResponse(false);
    }

    /**
     * @throws \Exception
     */
    public function authorize(): void
    {
        if ($this->allow) {
            return;
        }

        throw $this->failure->toException();
    }
}
