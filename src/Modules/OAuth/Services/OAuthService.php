<?php

namespace Modules\OAuth\Services;

use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\Role;
use Infrastructure\Eloquent\Models\SocialProvider;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\UserTrustedDevice;
use Infrastructure\Google2FA\Google2FAService;
use Infrastructure\Socialite\Facebook\FacebookUserProvider;
use Infrastructure\Socialite\Google\GoogleUserProvider;
use Laravel\Passport\Bridge\User as UserEntity;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Modules\OAuth\Dto\OAuthFacebookDto;
use Modules\OAuth\Dto\OAuthFacebookSignupDto;
use Modules\OAuth\Dto\OAuthGoogleDto;
use Modules\OAuth\Dto\OAuthGoogleSignupDto;
use Modules\OAuth\Dto\OAuthPasswordDto;
use Modules\OAuth\Dto\OAuthPasswordSignupDto;
use Modules\OAuth\Dto\OAuthVerifyOtpDto;
use Modules\OAuth\Enums\SocialProviderEnum;
use Modules\OAuth\Exceptions\InvalidOtpException;
use Modules\OAuth\Exceptions\InvalidOtpRecoveryCodeException;
use Modules\OAuth\Exceptions\OAuthServerException;
use Modules\Frontend\Dashboard\Company\Dto\CompanyCreateRequestDto;
use Modules\Frontend\Dashboard\Company\Services\CompanyCommandService;
use Str;

final class OAuthService
{
    /**
     */
    public function __construct(
        private readonly GoogleUserProvider $google,
        private readonly FacebookUserProvider $facebook,
        private readonly Google2FAService $tfa,
        private readonly CompanyCommandService $companyCommandService,
    ) {
        //
    }

    /**
     *
     */
    public function password(OAuthPasswordDto $request): ?UserEntityInterface
    {
        $user = User::query()->where('email', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return null;
        }

        return new UserEntity($user->getAuthIdentifier());
    }

    /**
     *
     */
    public function verifyOtp(OAuthVerifyOtpDto $request): void
    {
        $user = User::find($request->userId);

        if (!$user || !$user->google_2fa_enabled) {
            return;
        }

        if (UserTrustedDevice::query()->where('user_id', $user->id)
            ->where('ip', $request->ip)
            ->where('user_agent', $request->userAgent)
            ->where('valid_to', '>', now())->exists()) {
            return;
        }

        if (!is_null($request->otpRecoveryCode) && $request->otpRecoveryCode !== $user->google_2fa_recovery_code) {
            throw new InvalidOtpRecoveryCodeException();
        }

        if (is_null($request->otp) || !$this->tfa->verifyKey($user->google_2fa_secret, $request->otp)) {
            throw new InvalidOtpException();
        }

        if ($request->trusted) {
            Event::dispatch('auth_trusted_device.create', [
                [
                    'userId' => $user->id,
                    'ip' => $request->ip,
                    'userAgent' => $request->userAgent,
                ],
            ]);
        }
    }

    /**
     * @throws OAuthServerException
     */
    public function passwordSignup(OAuthPasswordSignupDto $request): UserEntityInterface
    {
        try {
            return DB::transaction(function () use ($request) {
                // Создание компании
                $companyDto = new CompanyCreateRequestDto(
                    $request->companyName,
                    Str::slug($request->companyName)
                );

                $company = $this->companyCommandService->create($companyDto);
                // Создание пользователя

                $user = User::create([
                    'email' => $request->username,
                    'password' => Hash::make($request->password),
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'registered_at' => now(),
                    'company_id' => $company->id,
                    'role_id' => Role::getDefaultRole()->id,
                ]);

                Event::dispatch('oauth.password_signed_up', [$user->id]);

                return new UserEntity($user->getAuthIdentifier());
            });
        } catch (Exception $e) {
            throw  OAuthServerException::invalidSignupCredentials();
        }
    }

    /**
     *
     */
    public function google(OAuthGoogleDto $request): ?UserEntityInterface
    {
        try {
            $source = $this->google->request($request->token);

            $user = User::query()
                ->whereHas('socialProviders', function ($query) use ($source) {
                    $query->where('provider_id', $source->id)
                        ->where('provider', SocialProviderEnum::GOOGLE->value);
                })
                ->firstOrFail();

            return new UserEntity($user->getAuthIdentifier());
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    /**
     * @throws OAuthServerException
     */
    public function googleSignup(OAuthGoogleSignupDto $request): ?UserEntityInterface
    {
        $source = $this->google->request($request->token);

        // Проверка, существует ли социальный провайдер
        $existingSocial = SocialProvider::where('provider_id', $source->id)
            ->where('provider', SocialProviderEnum::GOOGLE->value)
            ->first();

        if ($existingSocial) {
            $user = User::find($existingSocial->user_id);
            return new UserEntity($user->getAuthIdentifier());
        }

        try {
            $companyDto = new CompanyCreateRequestDto(
                $source->name,
                Str::slug($source->name),
            );

            $company = $this->companyCommandService->create($companyDto);

            $user = User::create([
                'registered_at' => now(),
                'company_id' => $company->id,
            ]);

            SocialProvider::create([
                'user_id' => $user->id,
                'provider_id' => $source->id,
                'provider' => SocialProviderEnum::GOOGLE->value,
            ]);

            Event::dispatch('oauth.google_signed_up', [$user->id]);

            return new UserEntity($user->getAuthIdentifier());
        } catch (Exception $e) {
            throw OAuthServerException::googleSignupFailed();
        }
    }

    /**
     *
     */
    public function facebook(OAuthFacebookDto $request): ?UserEntityInterface
    {
        try {
            $source = $this->facebook->request($request->token);

            $user = User::query()
                ->whereHas('socialProviders', function ($query) use ($source) {
                    $query->where('provider_id', $source->id)
                        ->where('provider', SocialProviderEnum::FACEBOOK->value);
                })
                ->firstOrFail();

            return new UserEntity($user->getAuthIdentifier());
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    /**
     * @throws OAuthServerException
     */
    public function facebookSignup(OAuthFacebookSignupDto $request): ?UserEntityInterface
    {
        $source = $this->facebook->request($request->token);

        $existingSocial = SocialProvider::with('user')->where('provider_id', $source->id)
            ->where('provider', SocialProviderEnum::FACEBOOK->value)
            ->first();

        if ($existingSocial) {
            $user = User::find($existingSocial->user_id);
            return new UserEntity($user->getAuthIdentifier());
        }

        // Создание компании
        try {
            $companyDto = new CompanyCreateRequestDto(
                $source->name,
                Str::slug($source->name),
            );

            $company = $this->companyCommandService->create($companyDto);

            $user = User::create([
                'registered_at' => now(),
                'company_id' => $company->id,
            ]);

            SocialProvider::create([
                'user_id' => $user->id,
                'provider_id' => $source->id,
                'provider' => SocialProviderEnum::FACEBOOK->value,
            ]);

            Event::dispatch('oauth.facebook_signed_up', [$user->id]);

            return new UserEntity($user->getAuthIdentifier());
        } catch (Exception $e) {
            throw OAuthServerException::facebookSignupFailed();
        }
    }
}
