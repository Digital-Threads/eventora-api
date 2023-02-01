<?php

namespace Infrastructure\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

final class CheckException extends Exception
{
    public function __construct(
        public readonly CheckFailure $failure,
    ) {
        parent::__construct($failure->message);
    }

    public function render(): JsonResponse
    {
        return response()->error(
            $this->failure->error,
            Translator::translate($this->failure->errorDescription),
            Translator::translate($this->failure->message),
            Translator::translate($this->failure->hint),
            JsonResponse::HTTP_FORBIDDEN,
        );
    }
}
