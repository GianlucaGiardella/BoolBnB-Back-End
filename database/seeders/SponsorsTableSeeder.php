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
        foreach (config('bnb.apartments_sponsors') as $apartment_sponsor) {

            foreach (Sponsor::all() as $sponsor) {

                foreach (Apartment::all() as $apartment) {

                    if ($apartment['id'] == $apartment_sponsor['apartment_id'] && $sponsor['id'] == $apartment_sponsor['sponsor_id']) {
                        $duration = $sponsor['duration'];
                        $apartment_sponsor['end_date'] = date('Y-m-d H:i:s', strtotime($apartment_sponsor['start_date']. ' + '.$duration.' hours'));
                        $sponsor->apartments()->attach($apartment->id, array("start_date"=>$apartment_sponsor["start_date"], "end_date"=>$apartment_sponsor["end_date"]));
                    
                    }
                }

                $sponsor->save();
            }
        }
    }
}