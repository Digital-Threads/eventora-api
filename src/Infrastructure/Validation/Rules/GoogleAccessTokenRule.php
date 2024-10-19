<?php

namespace Infrastructure\Validation\Rules;

use Exception;
use Google_Client;
use Google_Service_Oauth2;
use Illuminate\Contracts\Validation\Rule;

class GoogleAccessTokenRule implements Rule
{
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The provided Google access token is invalid.';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);

        try {
            $client->setAccessToken($value);
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();

            return !empty($userInfo);
        } catch (Exception $e) {
            return false;
        }
    }
}
