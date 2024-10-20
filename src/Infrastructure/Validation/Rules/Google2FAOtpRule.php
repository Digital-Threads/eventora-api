<?php

namespace Infrastructure\Validation\Rules;

use Exception;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Log;
use Infrastructure\Eloquent\Models\User;
use Illuminate\Contracts\Validation\Rule;

class Google2FAOtpRule implements Rule
{
    protected User      $user;

    protected Google2FA $google2fa;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->google2fa = new Google2FA();
    }

    /**
     *
     */
    public function message(): string
    {
        return 'The provided OTP is invalid.';
    }

    /**
     * @param string $attribute
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return $this->google2fa->verifyKey($this->user->google_2fa_secret, $value);
        } catch (Exception $e) {
            Log::error('Google2FAOtpRule error: ' . $e->getMessage());

            return false;
        }
    }
}
