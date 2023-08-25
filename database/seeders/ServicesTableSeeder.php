<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('services') as $objService) {
            $service = Service::create([
                'id'   => $objService->id,
                'name' => $objService->name_service,
                'icon' => $objService->icons_services,
            ]);
        }
    }
}
