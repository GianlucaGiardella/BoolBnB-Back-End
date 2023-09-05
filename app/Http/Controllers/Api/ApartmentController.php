<?php

namespace App\Http\Controllers\Api;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $services = $request->input('services');

        if ($services) {
            $apartments = Apartment::whereHas('services', function ($query) use ($services) {
                $query->whereIn('id', $services);
            })->get();
        } else {
            $apartments = Apartment::with(['user', 'services', 'images', 'messages', 'sponsors', 'views'])->get();
        }

        return response()->json([
            'success'   => true,
            'results'   => $apartments,
        ]);
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

    public function search(Request $request): JsonResponse
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $distance = $request->input('distance');
        $size = $request->input('size');
        $rooms = $request->input('rooms');
        $beds = $request->input('beds');
        $bathrooms = $request->input('bathrooms');
        $services = $request->input('services');

        $apartments = $this->getApartmentsFiltered(
            $latitude,
            $longitude,
            $distance,
            $size,
            $rooms,
            $beds,
            $bathrooms,
            $services
        );

        if (count($apartments) == 0) {
            return response()->json(['apartments' => null], 200);
        }
        return response()->json(['apartments' => $apartments]);
    }

    public function getApartmentsFiltered(
        $latitude,
        $longitude,
        $distance,
        $size,
        $rooms,
        $beds,
        $bathrooms,
        $services
    ) {
        $earthRadius = 6371;
        $apartments = Apartment::select('apartments.*')
            ->selectRaw(
                "( $earthRadius * acos(
            cos( radians($latitude) )
            * cos( radians( apartments.latitude ) )
            * cos( radians( apartments.longitude ) - radians($longitude) )
            + sin( radians($latitude) )
            * sin( radians( apartments.latitude ) )
        )) AS distance"
            )->whereRaw("( $earthRadius * acos(
            cos( radians($latitude) )
            * cos( radians( apartments.latitude ) )
            * cos( radians( apartments.longitude ) - radians($longitude) )
            + sin( radians($latitude) )
            * sin( radians( apartments.latitude ) )
        )) <= ?", [$distance])
            ->orderBy('distance')
            ->with(['services', 'images', 'messages']);

        $apartments->where('size', '>=', $size);
        $apartments->where('rooms', '>=', $rooms);
        $apartments->where('beds', '>=', $beds);
        $apartments->where('bathrooms', '>=', $bathrooms);

        if ($services) {
            $apartments->whereHas('services', function ($query) use ($services) {
                $query->whereIn('id', $services);
            }, '=', count($services));
        }
        return $apartments->get();
    }

    // public function search(Request $request)
    // {
    //     $apartments = Apartment::with('services')
    //         ->when($request->input('services'), function ($query, $services) {
    //             $query->whereHas('services', function ($query) use ($services) {
    //                 $query->whereIn('id', $services);
    //             }, '=', count($services));
    //         })
    //         ->when($request->input('size'), function ($query, $size) {
    //             $query->where('size', '>=', $size);
    //         })
    //         ->when($request->input('rooms'), function ($query, $rooms) {
    //             $query->where('rooms', '>=', $rooms);
    //         })
    //         ->when($request->input('beds'), function ($query, $beds) {
    //             $query->where('beds', '>=', $beds);
    //         })
    //         ->when($request->input('bathroom'), function ($query, $bathrooms) {
    //             $query->where('bathroom', '>=', $bathrooms);
    //         })->get();

    //     return response()->json([
    //         'success'   => true,
    //         'results'   => $apartments,
    //     ]);
    // }
}