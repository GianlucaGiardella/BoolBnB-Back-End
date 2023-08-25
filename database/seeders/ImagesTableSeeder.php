<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImagesTableSeeder extends Seeder
{
    public function run()
    {
        $images = config('images');
        foreach ($images as $image) {
            Image::create($image);
        }
    }
}