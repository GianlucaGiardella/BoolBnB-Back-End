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

        $newApartment               = new Apartment();

        $newApartment->user_id      = Auth::id();
        $newApartment->title        = $data['title'];
        $newApartment->description  = $data['description'];
        $newApartment->price        = $data['price'];
        $newApartment->latitude     = $data['latitude'];
        $newApartment->longitude    = $data['longitude'];
        $newApartment->size         = $data['size'];
        $newApartment->rooms        = $data['rooms'];
        $newApartment->beds         = $data['beds'];
        $newApartment->bathrooms    = $data['bathrooms'];
        $newApartment->visibility   = $data['visibility'];
        $newApartment->cover        = $data['cover'];

        $newApartment->save();

        return view('admin.apartments.index');
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