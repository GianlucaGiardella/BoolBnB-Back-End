<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $views = config('views');
            foreach ($views as $view) { 
                View::create($views);
            }
    }
}
