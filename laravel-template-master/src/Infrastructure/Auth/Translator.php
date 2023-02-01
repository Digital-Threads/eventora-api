<?php

namespace Infrastructure\Auth;

use Illuminate\Support\Facades\Lang;

final class Translator
{
    public static function translate(?string $message): ?string
    {
        if (!$message) {
            return null;
        }

        $key = "auth.checks.{$message}";

        if (!Lang::has($key)) {
            return null;
        }

        return trans($key);
    }
}
