<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;

use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        $apartment = Apartment::all(); 
        $userApartments = auth()->user()->apartments;
        $userSponsor = auth()->user()->sponsor;

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $token = $gateway->clientToken()->generate();
        return view('admin.sponsors.index', compact('sponsors', 'apartment', 'userApartments', 'gateway', 'token', 'userSponsor'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sponsor $sponsor)
    {
        //
    }

    public function edit(Sponsor $sponsor)
    {
        //
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
