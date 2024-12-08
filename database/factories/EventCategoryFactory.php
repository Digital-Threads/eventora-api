<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\EventCategory;

class EventCategoryFactory extends Factory
{
    protected $model = EventCategory::class;

    public function definition(): array
    {
        $name =$this->faker->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
