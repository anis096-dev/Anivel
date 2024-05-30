<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::firstOrCreate([
            'name' => 'Tunisia',
            'slug' => 'TN',
            'iso3' => 'TUN',
            'country_code' => '+216',
            'currency' => 'TND'
        ]);

        Country::firstOrCreate([
            'name' => 'United State America',
            'slug' => 'US',
            'iso3' => 'USA',
            'country_code' => '+1',
            'currency' => 'USD'
        ]);
    }
}
