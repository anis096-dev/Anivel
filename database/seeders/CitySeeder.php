<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::firstOrCreate([
            'country_id'=> Country::where('slug','TN')->first()->id,
            'name'=>'Jendouba',
            'slug'=>'jendouba',
        ]);
        
        City::firstOrCreate([
            'country_id'=> Country::where('slug','TN')->first()->id,
            'name'=>'Tunis',
            'slug'=>'tunis',
        ]);

        City::firstOrCreate([
            'country_id'=> Country::where('slug','US')->first()->id,
            'name'=>'New York',
            'slug'=>'new-york',
        ]);

        
        City::firstOrCreate([
            'country_id'=> Country::where('slug','US')->first()->id,
            'name'=>'New Jersy',
            'slug'=>'new-jersy',
        ]);
    }
}
