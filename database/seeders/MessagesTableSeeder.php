<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        foreach (config('bnb.messages') as $message) {
            $newMessage = new Message();

            $newMessage->apartment_id = $message["apartment_id"];
            $newMessage->email_sender = $message["email_sender"];
            $newMessage->message_text = $message["text_message"];
            $newMessage->sent_at = $message["sent_at"];

            $newMessage->save();
        }
    }
}