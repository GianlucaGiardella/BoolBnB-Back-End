<?php

namespace App\Http\Controllers\Api;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        // $apartment = Apartment::all();
        // return response()->json([
        //     'success'   => true,
        //     'results'   => $apartment,
        // ]);

        // $apartments = Apartment::with(["images", "services"])->get();
        // return response()->json([
        //     'success'   => true,
        //     'results'   => $apartments,
        // ]);

        $selectedServices = $request->input('services');

        if ($selectedServices) {
            $apartments = Apartment::whereHas('services', function ($query) use ($selectedServices) {
                $query->whereIn('id', $selectedServices);
            })->get();
        } else {
            $apartments = Apartment::with(['user', 'services', 'images', 'sponsors'])->get();
        }

        return response()->json([
            'success'   => true,
            'results'   => $apartments,
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
        // $apartment = Apartment::where('slug', $slug)->firstOrFail();

        $apartment = Apartment::where("slug", $slug)->with(["images", "services"])->firstOrFail();

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