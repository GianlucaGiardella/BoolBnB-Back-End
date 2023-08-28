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
        foreach (config('bnb.services') as $service) {
            Service::create($service);
        }

        foreach (config('bnb.apartments_services') as $apartment_service) {
        }
    }
}