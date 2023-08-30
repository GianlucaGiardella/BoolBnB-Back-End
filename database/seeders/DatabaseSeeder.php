<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            //Apartment deve essere creato prima 
            ApartmentsTableSeeder::class,
            ServicesTableSeeder::class,
            SponsorsTableSeeder::class,
            ImagesTableSeeder::class,
            MessagesTableSeeder::class,
            ViewsTableSeeder::class,
        ]);
    }
}