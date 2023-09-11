<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Models\ApartmentSponsor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    // Validation 
    private $validations = [
        'title'                 => 'required|string|min:3|max:255',
        'country'               => 'required|string',
        'street'                => 'required|string|max:255',
        'zip'                   => 'required|integer',
        'size'                  => 'required|integer|min:1|max:9999',
        'rooms'                 => 'required|integer|min:1|max:99',
        'beds'                  => 'required|integer|min:1|max:99',
        'bathrooms'             => 'required|integer|min:1|max:99',
        'street'                => 'required|string|min:3|max:255',
        'description'           => 'required|string',
        'services'              => 'nullable|array',
        'services.*'            => 'integer|exists:services,id',
        'sponsors'              => 'nullable|array',
        'sponsors.*'            => 'integer|exists:sponsors,id',
    ];

    private $validationMessages = [
        'required'              => 'Campo obbligatorio',
        'exists'                => 'Il valore non esiste.',
        'min'                   => 'Il campo :attribute deve avere almeno :min caratteri.',
        'max'                   => 'Il campo :attribute non deve superare i :max caratteri.',
    ];

    public function index()
    {
        $apartments = Apartment::with('user')->where('user_id', Auth::id())->paginate(5);

        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.apartments.index', compact('apartments', 'messages'));
    }

    public function create()
    {
        // Get all tables
        $apartments = Apartment::all();
        $services = Service::all();
        $sponsors = Sponsor::all();

        return view('admin.apartments.create', compact('apartments', 'services', 'sponsors'));
    }

    public function store(Request $request)
    {

        // Validation
        $request->validate($this->validations, $this->validationMessages);

        // Get all requests
        $data = $request->all();

        // Geocoding 
        $country                = $data['country'];
        $street_endcode         = urlencode($data['street']);
        $zip                    = $data['zip'];

        // Structured Search
        $url = "https://api.tomtom.com/search/2/structuredGeocode.json?countrySet={$country}&limit=1&streetNumber={$zip}&streetName={$street_endcode}&language=it-IT&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R";

        $response_json = file_get_contents($url);
        $responseData = json_decode($response_json, true);
        error_log(print_r($responseData, true));

        if (isset($responseData['results'][0]['position']['lat']) && isset($responseData['results'][0]['position']['lon'])) {

            // Set Lat & Lon
            $longitude = $responseData['results'][0]['position']['lon'];
            $latitude = $responseData['results'][0]['position']['lat'];

            // New Apartment
            $newApartment               = new Apartment();

            $newApartment->user_id      = Auth::id();
            $newApartment->title        = $data['title'];
            $newApartment->slug         = Apartment::slugger($data['title']);
            $newApartment->country      = $data['country'];
            $newApartment->street       = $data['street'];
            $newApartment->zip          = $data['zip'];
            $newApartment->size         = $data['size'];
            $newApartment->rooms        = $data['rooms'];
            $newApartment->beds         = $data['beds'];
            $newApartment->bathrooms    = $data['bathrooms'];
            $newApartment->latitude     = $longitude;
            $newApartment->longitude    = $latitude;
            $newApartment->description  = $data['description'];
            $newApartment->visibility   = $data['visibility'];

            // Visibility
            if (isset($request->visibility)) {
                $data['visibility'] = true;
            } else {
                $data['visibility'] = false;
            };

            // Cover
            if (isset($data['cover'])) {
                $coverPath = Storage::put('img', $data['cover']);
                $newApartment->cover = $coverPath;
            }

            // Create apartment
            $newApartment->save();

            // Services
            if ($data['services']) {
                $services = array_values($data['services']);
                $newApartment->services()->sync($services);
            }

            // Images
            for ($i = 0; $i < 5; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $imageFile = $request->file('image' . $i);
                    $extension = $imageFile->getClientOriginalExtension();
                    $imageName = uniqid() . ".{$extension}";
                    $imagePath = $imageFile->storeAs('img', $imageName, 'public');

                    $newImage = [
                        'apartment_id' => $newApartment->id,
                        'img_url' => $imagePath
                    ];

                    $newApartment->images()->create($newImage);
                }
            }
        } else {
            return back()->withInput()->withErrors(['api_error' => 'Indirizzo non trovato']);
        }

        return view('admin.apartments.show', ['apartment' => $newApartment]);
    }

    public function show($slug)
    {
        // User control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);
        $apartmentSponsor = ApartmentSponsor::all()->firstOrFail();

        return view('admin.apartments.show', compact('apartment', 'apartmentSponsor'));
    }

    public function edit($slug)
    {
        // User control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        // Get all tables
        $services = Service::all();
        $sponsors = Sponsor::all();
        $messages = Message::all();

        return view('admin.apartments.edit', compact('apartment', 'services', 'messages'));
    }

    public function update(Request $request, $slug)
    {
        // User control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        // Validation
        $request->validate($this->validations, $this->validationMessages);

        // Get all requests
        $data = $request->all();

        // Services
        if ($data['services']) {
            $services = array_values($data['services']);

            $apartment->services()->sync($services);
        }

        // Set visibility
        if (isset($request->visibility)) {
            $data['visibility'] = true;
        } else {
            $data['visibility'] = false;
        };

        // Cover
        if ($request->hasFile('cover')) {

            $coverFile = $request->file('cover');
            $extension = $coverFile->getClientOriginalExtension();
            $coverName = uniqid() . ".{$extension}";
            $coverPath = $coverFile->storeAs('img', $coverName, 'public');

            if ($apartment->cover) {
                Storage::delete($apartment->cover);
            }

            $apartment->cover = $coverPath;
        } else if (!$request->filled('old_cover')) {

            if ($apartment->cover) {
                Storage::delete($apartment->cover);
            }

            $apartment->cover = null;
        }

        // Images
        for ($i = 0; $i < 5; $i++) {
            if ($request->hasFile('image' . $i)) {

                $imageFile = $request->file('image' . $i);
                $extension = $imageFile->getClientOriginalExtension();
                $imageName = uniqid() . ".{$extension}";
                $imagePath = $imageFile->storeAs('img', $imageName, 'public');

                $imageAtIndex = $apartment->images->get($i);

                if ($imageAtIndex) {

                    Storage::delete($imageAtIndex->img_url);

                    $imageAtIndex->img_url = $imagePath;
                    $imageAtIndex->save();
                } else {

                    $apartment->images()->create([
                        'apartment_id' => $apartment->id,
                        'img_url' => $imagePath
                    ]);
                }
            } else if (!$request->filled('old_image' . $i)) {

                $imageAtIndex = $apartment->images->get($i);

                if ($imageAtIndex) {
                    Storage::delete($imageAtIndex->img_url);
                    $imageAtIndex->delete();
                }
            }
        }

        // Geocoding
        $country            = $data['country'];
        $street_endcode     = urlencode($data['street']);
        $zip                = $data['zip'];

        // Structured Search
        $url = "https://api.tomtom.com/search/2/structuredGeocode.json?countryCode={$country}&limit=1&streetNumber={$zip}&streetName={$street_endcode}&language=it-IT&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R";

        $response_json  =   file_get_contents($url);
        $responseData   =   json_decode($response_json, true);

        error_log(print_r($responseData, true));

        if (isset($responseData['results'][0]['position']['lat']) && isset($responseData['results'][0]['position']['lon'])) {

            // Set new lat & lon
            $longitude = $responseData['results'][0]['position']['lon'];
            $latitude = $responseData['results'][0]['position']['lat'];

            // Update 
            $apartment->title        = $data['title'];
            $apartment->description  = $data['description'];
            $apartment->country      = $country;
            $apartment->street       = $data['street'];
            $apartment->zip          = $data['zip'];
            $apartment->latitude     = $longitude;
            $apartment->longitude    = $latitude;
            $apartment->size         = $data['size'];
            $apartment->rooms        = $data['rooms'];
            $apartment->beds         = $data['beds'];
            $apartment->bathrooms    = $data['bathrooms'];
            $apartment->visibility   = $data['visibility'];

            $apartment->update();

            $apartment->services()->sync(isset($data['services']) ? $data['services'] : []);
        } else {
            return back()->withInput()->withErrors(['api_error' => 'Indirizzo non trovato']);
        }

        return to_route('admin.apartments.index');
    }

    public function destroy($slug)
    {
        // User control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        // Delete apartment tables
        $apartment->services()->detach();
        $apartment->sponsors()->detach();
        $apartment->messages()->delete();
        $apartment->views()->delete();

        // Delete cover from storage
        if ($apartment->cover) {
            Storage::delete($apartment->cover);
        }

        // Delete all apartment images from storage & table
        if ($apartment->images) {
            foreach ($apartment->images as $image) {
                Storage::delete($image->img_url);
            }
            $apartment->images()->delete();
        }

        // Delete apartment
        $apartment->delete();

        return to_route('admin.apartments.index')->with('delete_success', $apartment);
    }

    public function messages($slug)
    {
        // User control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        $messages = Message::where('apartment_id', $apartment->id)->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.apartments.message', compact('messages', 'apartment'));
    }

    public function sponsors($slug)
    {
        // User control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        $apartments = Apartment::where('id', $apartment->id)->get();
        $sponsors = Sponsor::all();

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $token = $gateway->clientToken()->generate();
        $apartmentSponsor = ApartmentSponsor::all()->firstOrFail();
        return view('admin.apartments.sponsor', compact('sponsors', 'apartment', 'gateway', 'token', 'apartments', 'apartmentSponsor'));
    }
}