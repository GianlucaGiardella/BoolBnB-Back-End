<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('message') as $objMessage)

        $message = Message::create([
            'email_sender' => $objMessage['email_sender'],
            'text_message' => $objMessage['text_message'],
            'sent_date' => $objMessage['sent_date'],
        ]);
    }
}
