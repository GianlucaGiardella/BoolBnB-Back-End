<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SponsorsTableSeeder extends Seeder
{
    public function run()
    {
        $sponsors = [
            [
                'name' => 'Bronzo',
                'price' => 2.99,
                'duration' => 24,
            ],
            [
                'name' => 'Argento',
                'price' => 5.99,
                'duration' => 72,
            ],
            [
                'name' => 'Oro',
                'price' => 9.99,
                'duration' => 144,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            $newSponsor = new Sponsor();
            $newSponsor->name = $sponsor['name'];
            $newSponsor->price = $sponsor['price'];
            $newSponsor->duration = $sponsor['duration'];
            $newSponsor->save();
        }
    }
}