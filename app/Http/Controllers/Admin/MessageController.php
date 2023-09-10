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
        $user_id = Auth::user()->id;

        $apartments = Apartment::all()->where('user_id', $user_id);

        $messages = Message::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.messages.index', compact('apartments', 'messages'));
    }
}