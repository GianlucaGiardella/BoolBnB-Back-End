<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('messages') as $objMessage) {
            Message::create([
                'email_sender' => $objMessage['email_sender'],
                'text_message' => $objMessage['text_message'],
                'sent_date' => $objMessage['sent_date']
            ]);
        }
    }
}