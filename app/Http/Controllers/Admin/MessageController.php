<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user_id=Auth::user()->id;
 
        $messages = [];
        
        $apartments = Apartment::all()->where('user_id', $user_id);

        $messagesList = Message::all();

        foreach ($apartments as $apartment) {
            foreach ($messagesList as $message) {
                if($message['apartment_id'] == $apartment['id']){
                    array_push($messages, $message);
                }
            }
        }
        $messages = collect($messages)->sortBy('date')->reverse();
        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Apartment $apartment)
    {
        // 
    }

    public function edit(Message $message)
    {
        //
    }

    public function update(Request $request, Message $message)
    {
        //
    }

    public function destroy(Message $message)
    {
        //
    }
}