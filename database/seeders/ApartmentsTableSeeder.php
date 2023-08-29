<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\View;
use App\Models\Image;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();
        $services = Service::all();
        $sponsors = Sponsor::all()->pluck('id');

        foreach (config('bnb.apartments') as $config_apartment) {
            $title = $config_apartment['title'];
            $slug = Apartment::slugger($title);

            $apartment = Apartment::create([
                'user_id'       => $config_apartment['user_id'],
                'title'         => Str::ucfirst($title),
                'slug'          => $slug,
                'description'   => $config_apartment['description'],
                'address'       => $config_apartment['address'],
                'longitude'     => $config_apartment['longitude'],
                'latitude'      => $config_apartment['latitude'],
                'rooms'         => $config_apartment['rooms'],
                'beds'          => $config_apartment['beds'],
                'bathrooms'     => $config_apartment['bathrooms'],
                'size'          => $config_apartment['size'],
                'visibility'    => $config_apartment['visibility'],
                'cover'         => $config_apartment['cover'],
            ]);

            //Usa Faker per creare una tabella ponte casuale con services e sponsors

            // $apartment->services()->sync($faker->randomElements($services, null));
            // $apartment->sponsors()->sync($faker->randomElements($sponsors, null));
        }
    }
}