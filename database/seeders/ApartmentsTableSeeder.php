<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\View;
use App\Models\Image;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('bnb.apartments') as $config_apartment) {
            $title = $config_apartment['title'];
            $slug = Apartment::slugger($title);

            Apartment::create([
                'user_id'       => $config_apartment['user_id'],
                'title'         => Str::ucfirst($title),
                'slug'          => $slug,
                'description'   => $config_apartment['description'],
                'country'       => $config_apartment['country'],
                'street'        => $config_apartment['street'],
                'zip'           => $config_apartment['zip'],
                'longitude'     => $config_apartment['longitude'],
                'latitude'      => $config_apartment['latitude'],
                'rooms'         => $config_apartment['rooms'],
                'beds'          => $config_apartment['beds'],
                'bathrooms'     => $config_apartment['bathrooms'],
                'size'          => $config_apartment['size'],
                'visibility'    => $config_apartment['visibility'],
                'cover'         => $config_apartment['cover'],
            ]);
        }
    }
}