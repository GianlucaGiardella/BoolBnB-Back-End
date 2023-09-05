<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $apartment_id = $request->input('apartment_id');

        $query = Message::query();

        if ($apartment_id) {
            $query->where('apartment_id', $apartment_id);
        }

        // Order the messages by sent_at in descending order
        $messages = $query->orderByDesc('sent_date')->get();

        // Fetch apartments owned by the authenticated user
        $apartments = Apartment::where('user_id', $user->id)->get();

        return view('admin.messages.index', compact('messages', 'user', 'apartment_id', 'apartments'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Message $message)
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
