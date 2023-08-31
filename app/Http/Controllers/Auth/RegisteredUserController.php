<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    private $validations = [
        'name'              => 'string|max:50|nullable',
        'surname'           => 'string|max:50|nullable',
        'birth_date'        => 'date|nullable',
        'email'             => 'required|string|email|max:255|unique:users',
        'password'          => 'required|confirmed|min:8',
    ];

    private $validationMessages = [
        'required'              => 'Campo obbligatorio.',
        'min'                   => 'Il campo :attribute deve avere almeno :min caratteri.',
        'max'                   => 'Il campo :attribute non deve superare i :max caratteri.',
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
            'name' => ucwords($data['name']),
            'surname' => ucwords($data['surname']),
            'birth_date' => $data['birth_date'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}