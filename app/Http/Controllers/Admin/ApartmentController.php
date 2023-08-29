<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('user')->where('user_id', Auth::id())->paginate(8);

        return view('admin.apartments.index', compact('apartments'));
    }

    public function create()
    {
        $apartments = Apartment::all();

        return view('admin.apartments.create', compact('apartments'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //geocoding 
        $address = $data['address'];
        $address = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R";
        $response_json = file_get_contents($url);
        $responseData = json_decode($response_json, true);
        error_log(print_r($responseData, true));

        if (isset($responseData['results'][0]['position']['lat']) && isset($responseData['results'][0]['position']['lon'])) {

            $latitude = $responseData['results'][0]['position']['lat'];
            $longitude = $responseData['results'][0]['position']['lon'];

            $newApartment               = new Apartment();
            $newApartment->user_id      = Auth::id();
            $newApartment->title        = $data['title'];
            $newApartment->description  = $data['description'];
            $newApartment->price        = $data['price'];
            $newApartment->latitude     = $latitude;
            $newApartment->longitude    = $longitude;
            $newApartment->size         = $data['size'];
            $newApartment->rooms        = $data['rooms'];
            $newApartment->beds         = $data['beds'];
            $newApartment->bathrooms    = $data['bathrooms'];
            $newApartment->visibility   = $data['visibility'];
            $newApartment->cover        = $data['cover'];

            $newApartment->save();
        } else {
            return back()->withInput()->withErrors(['api_error' => 'Errore nella risposta API']);
        }

        return view('admin.apartments.index', compact('latitude', 'longitude'));
        // return view('admin.apartments.show', ['apartment' => $newApartment]);
    }

    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    public function edit(Apartment $apartment)
    {
        $apartment = Apartment::all();
        return view('admin.apartments.edit', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return to_route('admin.apartments.index')->with('success', 'apartment deleted successfully');
    }
}