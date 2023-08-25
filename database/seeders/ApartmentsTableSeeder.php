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
    public function run()
    {
        foreach (config('apartments') as $apartment) {
            Apartment::create($apartment);
        }
    }
}