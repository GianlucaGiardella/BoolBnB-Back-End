<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('bnb.sponsors') as $sponsor) {
            Sponsor::create($sponsor);
        }

        foreach (config('bnb.apartments_sponsors') as $apartment_sponsor) {
        }
    }
}