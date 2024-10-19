<?php

namespace Infrastructure\Validation\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class FacebookAccessTokenRule implements Rule
{
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The provided Facebook access token is invalid.';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        try {
            // Make a request to Facebook Graph API to verify the token
            $response = Http::get('https://graph.facebook.com/me', [
                'access_token' => $value,
            ]);

            // Check if the response is successful and contains user data
            if ($response->successful() && isset($response->json()['id'])) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}