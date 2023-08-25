<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersTableSeeder::class,
            SponsorsTableSeeder::class,
            ServicesTableSeeder::class,
            ApartmentsTableSeeder::class,
            MessagesTableSeeder::class,
            ImagesTableSeeder::class,
            ViewsTableSeeder::class,
        ]);
    }
}