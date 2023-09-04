<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    
    private $validations = [
        'email_sender'         =>'required|email|min:5|max:255',
        'text_message'       =>'required|string',
        'apartment_id'         => 'required',
    ];

    public function index()
    {
        $message = Message::all();
        return response()->json($message);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $data = $request->all();

        // validare i dati
        $validator = Validator::make($data, $this->validations);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors(),
            ]);
        }


        // salvare i dati del lead nel database
        $newMessage = new Message();
        $newMessage->email_sender         = $data["email_sender"];
        $newMessage->text_message       = $data["text_message"];
        $newMessage->apartment_id       = $data["apartment_id"];
        $newMessage->save();

        // ritornare un valore di successo al frontend
        return response()->json([
            "success" => true
        ]);
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