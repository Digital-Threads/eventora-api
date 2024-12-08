<?php

namespace Modules\OAuth\Services;


use Domain\SocialProvider\Repositories\SocialProviderCommandRepositoryInterface;
use Domain\SocialProvider\Repositories\SocialProviderQueryRepositoryInterface;
use Domain\User\Repositories\UserCommandRepositoryInterface;
use Domain\User\Repositories\UserQueryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\Role;
use Infrastructure\Google2FA\Google2FAService;
use Infrastructure\Socialite\Facebook\FacebookUserProvider;
use Infrastructure\Socialite\Google\GoogleUserProvider;
use Laravel\Passport\Bridge\User as UserEntity;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Modules\Company\Dto\CompanyCreateRequestDto;
use Modules\Company\Services\CompanyCommandService;
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

final class OAuthService
{
    public function __construct(
        private readonly GoogleUserProvider                       $google,
        private readonly FacebookUserProvider                     $facebook,
        private readonly Google2FAService                         $tfa,
        private readonly CompanyCommandService                    $companyCommandService,
        private readonly UserCommandRepositoryInterface           $userCommandRepository,
        private readonly UserQueryRepositoryInterface             $userQueryRepository,
        private readonly SocialProviderCommandRepositoryInterface $socialProviderCommandRepository,
        private readonly SocialProviderQueryRepositoryInterface   $socialProviderQueryRepository,
    ) {
        //
    }

    public function password(OAuthPasswordDto $request): ?UserEntityInterface
    {
        $user = $this->userQueryRepository->findByEmail($request->username);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return null;
        }

        return new UserEntity($user->getAuthIdentifier());
    }

    public function verifyOtp(OAuthVerifyOtpDto $request): void
    {
        $user = $this->userQueryRepository->findById($request->userId);

        if (!$user || !$user->google_2fa_enabled) {
            return;
        }

        if ($this->userQueryRepository->findAllByUserId($user->id)) {
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
                    'userId'    => $user->id,
                    'ip'        => $request->ip,
                    'userAgent' => $request->userAgent,
                ],
            ]);
        }
    }

    public function passwordSignup(OAuthPasswordSignupDto $request): UserEntityInterface
    {
        return DB::transaction(function () use ($request) {
            $companyDto = new CompanyCreateRequestDto(
                $request->companyName,
                Str::slug($request->companyName)
            );

            $company = $this->companyCommandService->create($companyDto);

            $user = $this->userCommandRepository->create([
                'email'         => $request->username,
                'password'      => Hash::make($request->password),
                'first_name'    => $request->firstName,
                'last_name'     => $request->lastName,
                'registered_at' => now(),
                'company_id'    => $company->id,
                'role_id'       => Role::getDefaultRole()->id,
            ]);

            Event::dispatch('oauth.password_signed_up', [$user->id]);

            return new UserEntity($user->getAuthIdentifier());
        });
    }

    public function google(OAuthGoogleDto $request): ?UserEntityInterface
    {
        try {
            $source = $this->google->request($request->token);

            $socialProvider = $this->socialProviderQueryRepository->findByProviderId($source->id);

            if (!$socialProvider) {
                throw new ModelNotFoundException();
            }

            $user = $this->userQueryRepository->findById($socialProvider->user_id);

            if (!$user) {
                throw new ModelNotFoundException();
            }

            return new UserEntity($user->getAuthIdentifier());
        } catch(ModelNotFoundException) {
            return null;
        }
    }

    public function googleSignup(OAuthGoogleSignupDto $request): ?UserEntityInterface
    {
        $source = $this->google->request($request->token);

        $existingSocial = $this->socialProviderQueryRepository->findByProviderId($source->id);

        if ($existingSocial) {
            $user = $this->userQueryRepository->findById($existingSocial->user_id);

            return new UserEntity($user->getAuthIdentifier());
        }

        return DB::transaction(function () use ($source) {
            $companyDto = new CompanyCreateRequestDto(
                $source->name,
                Str::slug($source->name)
            );

            $company = $this->companyCommandService->create($companyDto);

            $user = $this->userCommandRepository->create([
                'registered_at' => now(),
                'company_id'    => $company->id,
            ]);

            $this->socialProviderCommandRepository->linkProvider($user->id, SocialProviderEnum::GOOGLE->value, $source->id);

            Event::dispatch('oauth.google_signed_up', [$user->id]);

            return new UserEntity($user->getAuthIdentifier());
        });
    }

    public function facebook(OAuthFacebookDto $request): ?UserEntityInterface
    {
        try {
            $source = $this->facebook->request($request->token);

            $socialProvider = $this->socialProviderQueryRepository->findByProviderId($source->id);

            if (!$socialProvider) {
                throw new ModelNotFoundException();
            }

            $user = $this->userQueryRepository->findById($socialProvider->user_id);

            if (!$user) {
                throw new ModelNotFoundException();
            }

            return new UserEntity($user->getAuthIdentifier());
        } catch(ModelNotFoundException) {
            return null;
        }
    }

    public function facebookSignup(OAuthFacebookSignupDto $request): ?UserEntityInterface
    {
        $source = $this->facebook->request($request->token);

        $existingSocial = $this->socialProviderQueryRepository->findByProviderId($source->id);

        if ($existingSocial) {
            $user = $this->userQueryRepository->findById($existingSocial->user_id);

            return new UserEntity($user->getAuthIdentifier());
        }

        return DB::transaction(function () use ($source) {
            $companyDto = new CompanyCreateRequestDto(
                $source->name,
                Str::slug($source->name)
            );

            $company = $this->companyCommandService->create($companyDto);

            $user = $this->userCommandRepository->create([
                'registered_at' => now(),
                'company_id'    => $company->id,
            ]);

            $this->socialProviderCommandRepository->linkProvider($user->id, SocialProviderEnum::FACEBOOK->value, $source->id);

            Event::dispatch('oauth.facebook_signed_up', [$user->id]);

            return new UserEntity($user->getAuthIdentifier());
        });
    }
}
