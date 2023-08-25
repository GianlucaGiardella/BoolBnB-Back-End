<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Apartment;
use App\Models\Image;
use App\Models\View;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApartmentsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $users = User::all();
        $images = Image::all();
        $views = View::all();

        // foreach (config('apartments') as $objApartment) {
        //     Apartment::create([
        //         // "id" => $objApartment['id'],
        //         "user_id" => $faker->randomElement($users)->id,
        //         "title" => $objApartment['title'],
        //         "price" => $objApartment['price'],
        //         "description" => $objApartment['description'],
        //         "longitude" => $objApartment['longitude'],
        //         "latitude" => $objApartment['latitude'],
        //         "rooms" => $objApartment['rooms'],
        //         "beds" => $objApartment['beds'],
        //         "bathrooms" => $objApartment['bathrooms'],
        //         "size" => $objApartment['size'],
        //         "visibility" => $faker->boolean(),
        //         "image_id" => $faker->randomElement($images)->id,
        //         "cover" => $objApartment['cover'],
        //         "view_id" => $faker->randomElement($views)->id,
        //     ]);
        // }

        foreach (config('apartments') as $apartment) {
            Apartment::create($apartment);
        }
    }
}