<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\View;
use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $users = User::all();

        foreach (config('bnb.apartments') as $apartment) {
            $title = $apartment['title'];
            $slug = Apartment::slugger($title);

            Apartment::create([
                'user_id'       => $apartment['user_id'],
                'title'         => Str::ucfirst($title),
                'slug'          => $slug,
                'description'   => $apartment['description'],
                'address'       => $apartment['address'],
                'longitude'     => $apartment['longitude'],
                'latitude'      => $apartment['latitude'],
                'rooms'         => $apartment['rooms'],
                'beds'          => $apartment['beds'],
                'bathrooms'     => $apartment['bathrooms'],
                'size'          => $apartment['size'],
                'visibility'    => $apartment['visibility'],
                'cover'         => $apartment['cover'],
            ]);
        }
    }
}