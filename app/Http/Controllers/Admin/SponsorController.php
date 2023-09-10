<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;

use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $sponsors = Sponsor::all();
        $userApartments = auth()->user()->apartments;
        $userSponsors = auth()->user()->sponsors;
        $apartments = Apartment::all()->where('user_id', $user_id);

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $token = $gateway->clientToken()->generate();

        return view('admin.sponsors.index', compact('gateway', 'token', 'userSponsors', 'userApartments', 'sponsors', 'user_id', 'apartments'));
    }
}