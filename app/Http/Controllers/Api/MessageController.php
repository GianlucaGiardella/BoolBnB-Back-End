<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Mail\NewContact;
use App\Models\Apartment;
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
        $newMessage->email_sender       = $request->input("email_sender");
        $newMessage->text_message       = $request->input("text_message");
        $newMessage->apartment_id       = $request->input("apartment_id");
        $newMessage->save();


        $apartment = Apartment::find($request->input('apartment_id'));
        $hostEmail = $apartment->user->email;
        $contactEmail = $request->input('email_sender');
        $messageContent = $request->input('text_message');
        $email = [
            'contactEmail' => $contactEmail,
            'messageContent' => $messageContent,
        ];

        Mail::to($hostEmail)->send(new NewContact($email));

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