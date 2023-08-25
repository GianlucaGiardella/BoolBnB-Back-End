<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('apartment-services') as $service) {
            Service::create($service);
        }
    }
}