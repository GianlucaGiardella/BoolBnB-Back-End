<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    private $validations = [
        'name'              => 'required|string|min:3|max:255',
        'surname'           => 'string|max:255|nullable',
        'birth_date'        => 'date|nullable',
        'email'             => 'required|string|email|max:255|unique:users',
        'password'          => 'required|confirmed|min:8',
    ];

    private $validationMessages = [
        'required'              => 'Field required.',
        'min'                   => 'The :attribute must be at least :min characters.',
        'max'                   => 'The :attribute can have a maximum of :max characters.',
    ];

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}