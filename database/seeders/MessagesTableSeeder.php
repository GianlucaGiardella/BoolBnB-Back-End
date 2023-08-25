<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('messages') as $message) {
            Message::create($message);
        }
    }
}