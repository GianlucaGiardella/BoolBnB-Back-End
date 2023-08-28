<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartment = Apartment::all();
        return view('admin.apartments.index', compact('index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartment = Apartment::all();

        return view('admin.apartments.create', compact('apartment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newApartment               = new Apartment();

        $newApartment->user_id      = $data['user_id'];
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
        //FIXME:
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $apartment = Apartment::all();
        return view('admin.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return to_route('admin.apartments.index')->with('success', 'apartment deleted successfully');
    }
}
