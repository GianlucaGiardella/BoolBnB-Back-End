<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImagesTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('images') as $image) {
            Image::create($image);
        }
    }
}