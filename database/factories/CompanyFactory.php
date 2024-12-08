<?php

namespace Database\Factories;


use Infrastructure\Eloquent\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\Event;
use Infrastructure\Eloquent\Models\User;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name'                 => $this->faker->company,
            'slug'                 => $this->faker->unique()->slug,
            'description'          => $this->faker->optional()->sentence,
            'avatar_url'           => $this->faker->optional()->imageUrl(),
            'website_url'          => $this->faker->optional()->url,
            'activity_description' => $this->faker->optional()->text(200),
        ];
    }

}
