<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Eloquent\Models\Company;
use Infrastructure\Eloquent\Models\Event;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\EventCategory;
use Illuminate\Support\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = EventCategory::factory(5)->create();
        $company = Company::factory()->create();
        $user = User::query()->first();

        // Создаем события
        Event::factory(20)->create()->each(function (Event $event) use ($categories, $user) {
            $event->update([
                'category_id' => $categories->random()->id,
                'organizer_id' => $user->id,
            ]);
        });
    }
}
