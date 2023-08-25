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

        // foreach (config('apartments') as $apartment) {
        //     $new_apartment = new Apartment();
        //     $new_apartment->user_id = $apartment['user_id'];
        //     $new_apartment->title = $apartment['title'];
        //     $new_apartment->price = $apartment['price'];
        //     $new_apartment->description = $apartment['description'];
        //     $new_apartment->longitude = $apartment['longitude'];
        //     $new_apartment->latitude = $apartment['latitude'];
        //     $new_apartment->rooms = $apartment['rooms'];
        //     $new_apartment->beds = $apartment['beds'];
        //     $new_apartment->bathrooms = $apartment['bathrooms'];
        //     $new_apartment->size = $apartment['size'];
        //     $new_apartment->visibility = $apartment['visibility'];
        //     $new_apartment->image_id = $apartment['image_id'];
        //     $new_apartment->cover = $apartment['cover'];
        //     $new_apartment->view_id = $apartment['view_id'];
        //     $new_apartment->save();
        // }

        foreach (config('apartments') as $apartment) {
            Apartment::create($apartment);
        }
    }
}