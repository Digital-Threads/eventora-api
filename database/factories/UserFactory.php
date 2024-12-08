<?php

namespace Database\Factories;


use Infrastructure\Eloquent\Models\Company;
use Infrastructure\Eloquent\Models\Role;
use Infrastructure\Eloquent\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verification_token' => $this->faker->optional()->uuid,
            'password' => bcrypt('password'),
            'google_2fa_secret' => $this->faker->optional()->uuid,
            'google_2fa_recovery_code' => $this->faker->optional()->uuid,
            'google_2fa_enabled' => $this->faker->boolean,
            'email_verified_at' => $this->faker->optional()->dateTime,
            'password_changed_at' => $this->faker->optional()->dateTime,
            'registered_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'role_id' => Role::query()->inRandomOrder()->value('id') ?: Role::factory(),
            'company_id' => Company::query()->inRandomOrder()->value('id') ?: Company::factory(),
        ];
    }

    public function withCompany(?Company $company = null): self
    {
        return $this->state(function () use ($company) {
            return ['company_id' => $company?->id ?? Company::factory()];
        });
    }

    public function withRole(?Role $role = null): self
    {
        return $this->state(function () use ($role) {
            return ['role_id' => $role?->id ?? Role::factory()];
        });
    }
}
