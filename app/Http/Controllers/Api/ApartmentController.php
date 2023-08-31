<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartment = Apartment::all();

        return response()->json([
            'success'   => true,
            'results'   => $apartment,
        ]);
    }

    public function create($id)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        return response()->json([
            'success'   => $apartment ? true : false,
            'results'   => $apartment,
        ]);
    }

    public function edit(Apartment $apartment)
    {
        //
    }

    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    public function destroy(Apartment $apartment)
    {
        //
    }
}
