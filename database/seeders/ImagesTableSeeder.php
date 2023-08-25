<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImagesTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $apartments = Apartment::All();

        foreach (config('images') as $image) {
            $newImage = new Image();
            $newImage->apartment_id = $image['apartment_id'];
            $newImage->img_url = $image['img_url'];
            $newImage->save();
        }
    }
}