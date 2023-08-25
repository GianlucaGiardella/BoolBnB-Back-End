<?php

namespace Database\Seeders;

use App\Models\Apartment;
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
