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
        foreach (config('bnb.sponsors') as $sponsor) {
            Sponsor::create($sponsor);
        }

        // foreach (config('bnb.apartments_sponsors') as $apartment_sponsor) {
        //     foreach (Sponsor::all() as $sponsor) {

        //         foreach (Apartment::all() as $apartment) {

        //             $duration = $sponsor['duration'];
        //             $apartment_sponsor['end_date'] = date('Y-m-d H:i:s', strtotime($apartment_sponsor['start_date'] . ' + ' . $duration . ' hours'));
        //             $sponsor->apartments()->attach($apartment->id, array(
        //                 "start_date" => $apartment_sponsor["start_date"],
        //                 "end_date" => $apartment_sponsor["end_date"]
        //             ));
        //         }
        //     }
        // }

        $apartments_sponsors = config('bnb.apartments_sponsors');
        foreach ($apartments_sponsors as $apartments_sponsors) {
            foreach (Sponsor::all() as $sponsor) {

                foreach (Apartment::all() as $apartment) {

                    if ($apartment['id'] == $apartments_sponsors['apartment_id'] && $sponsor['id'] == $apartments_sponsors['sponsor_id']) {
                        $duration = $sponsor['duration'];
                        $apartments_sponsors['end_date'] = date('Y-m-d H:i:s', strtotime($apartments_sponsors['start_date'] . ' + ' . $duration . ' hours'));
                        $sponsor->apartments()->attach($apartment->id, array("start_date" => $apartments_sponsors["start_date"], "end_date" => $apartments_sponsors["end_date"]));
                    }
                }
                $sponsor->save();
            }
        }
    }
}