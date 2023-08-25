<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // L'ORDINE E' IMPORTANTE
            UsersTableSeeder::class,
            SponsorsTableSeeder::class,
            ServicesTableSeeder::class,
            //Le altre necessitano dell'id di apartment, deve essere creato prima
            ApartmentsTableSeeder::class,
            ImagesTableSeeder::class,
            MessagesTableSeeder::class,
            ViewsTableSeeder::class,
        ]);
    }
}