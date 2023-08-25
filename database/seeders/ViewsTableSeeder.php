<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('views') as $view) {
            View::create($view);
        }
    }
}