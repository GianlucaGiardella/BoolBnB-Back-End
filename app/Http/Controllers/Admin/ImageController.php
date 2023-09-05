<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Image $images)
    {
        //
    }

    public function edit(Image $images)
    {
        //
    }

    public function update(Request $request, Image $images)
    {
        //
    }

    public function destroy($apartmentId, $id)
    {
        $apartment = Apartment::findOrFail($apartmentId);
        $image = Image::findOrFail($id);

        if ($apartment->images->contains($image)) {
            $apartment->images()->detach($image->id);
            Storage::delete($image->path);
            $image->delete();

            return redirect()->back()->with('success', 'Image removed from apartment successfully');
        }

        return redirect()->back()->with('error', 'Image is not associated with the apartment');

        // $image->apartments()->detach();
        // Storage::delete($image->path);

        // $image->delete();

        // return redirect()->back();
    }
}