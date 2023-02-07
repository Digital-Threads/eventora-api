<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Eloquent\Models\CompanyType;
use Str;

class CompanyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyTypes = [
            'Individual',
            'Family',
            'Business'
        ];

        foreach ($companyTypes as $type) {
            CompanyType::firstOrCreate([
                'name' => $type,
                'slug' => Str::slug('$type')
            ]);
        }
    }
}
