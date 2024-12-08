<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Eloquent\Models\Company;
use Infrastructure\Eloquent\Models\Event;
use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\User;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'location' => $this->faker->city(),
            'is_public' => $this->faker->boolean(),
            'terms_conditions' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(),
            'max_participants' => $this->faker->optional()->numberBetween(50, 500),
            'age_limit' => $this->faker->optional()->numberBetween(18, 50),
            'event_type' => $this->faker->randomElement(['online', 'offline']),
            'streaming_link' => $this->faker->optional()->url(),
            'tags' => $this->faker->optional()->words(3, false),
            'registration_deadline' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'qr_code' => Str::random(10),
            'organizer_id' => User::first()->id,
            'company_id' => Company::first()->id,
        ];
    }
}
