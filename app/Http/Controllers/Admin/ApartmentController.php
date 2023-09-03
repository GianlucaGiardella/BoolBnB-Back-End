<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    private $validations = [
        'title'                 => 'required|string|min:3|max:255',
        'country'               => 'required|string',
        'street'                => 'required|string|max:255',
        'civic'                 => 'required|integer',
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

        return view('admin.apartments.index', compact('apartments'));
    }

    public function create()
    {
        $apartments = Apartment::all();
        $services = Service::all();
        $sponsors = Sponsor::all();

        return view('admin.apartments.create', compact('apartments', 'services', 'sponsors'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        if (isset($request->visibility)) {
            $data['visibility'] = true;
        } else {
            $data['visibility'] = false;
        };

        //geocoding 

        $country            = $data['country'];
        $street_endcode     = urlencode($data['street']);
        $civic              = $data['civic'];

        $url = "https://api.tomtom.com/search/2/structuredGeocode.json?countrySet={$country}&limit=1&streetNumber={$civic}&streetName={$street_endcode}&language=it-IT&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R";

        $response_json = file_get_contents($url);
        $responseData = json_decode($response_json, true);
        error_log(print_r($responseData, true));

        if (isset($responseData['results'][0]['position']['lat']) && isset($responseData['results'][0]['position']['lon'])) {

            $latitude = $responseData['results'][0]['position']['lat'];
            $longitude = $responseData['results'][0]['position']['lon'];

            $newApartment               = new Apartment();

            if (isset($data['cover'])) {
                $coverPath = Storage::put('img', $data['cover']);
                $newApartment->cover = $coverPath;
            }

            $newApartment->user_id      = Auth::id();
            $newApartment->title        = $data['title'];
            $newApartment->slug         = Apartment::slugger($data['title']);
            $newApartment->size         = $data['size'];
            $newApartment->rooms        = $data['rooms'];
            $newApartment->beds         = $data['beds'];
            $newApartment->bathrooms    = $data['bathrooms'];
            $newApartment->country      = $data['country'];
            $newApartment->street       = $data['street'];
            $newApartment->latitude     = $latitude;
            $newApartment->longitude    = $longitude;
            $newApartment->description  = $data['description'];
            $newApartment->visibility   = $data['visibility'];

            $newApartment->save();
        } else {
            return back()->withInput()->withErrors(['api_error' => 'Indirizzo non trovato']);
        }

        // Porta all'index 
        // $apartments = Apartment::with('user')->where('user_id', Auth::id())->paginate(5);
        // return view('admin.apartments.index', compact('apartments'));

        return view('admin.apartments.show', ['apartment' => $newApartment]);
    }

    public function show($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        return view('admin.apartments.show', compact('apartment'));
    }

    public function edit($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        $services = Service::all();
        $sponsors = Sponsor::all();

        if (Auth::id() !== $apartment->user_id) abort(403);

        return view('admin.apartments.edit', compact('apartment', 'services'));
    }

    public function update(Request $request, $slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        if (isset($request->visibility)) {
            $data['visibility'] = true;
        } else {
            $data['visibility'] = false;
        };

        // if ($data['cover']) {
        //     $coverPath = Storage::put('img', $data['cover']);
        //     if ($apartment->cover) {
        //         Storage::delete($apartment->cover);
        //     }
        //     $apartment->cover = $coverPath;
        // }

        $country            = $data['country'];
        $street_endcode     = urlencode($data['street']);
        $civic              = $data['civic'];

        $url = "https://api.tomtom.com/search/2/structuredGeocode.json?countryCode={$country}&limit=1&streetNumber={$civic}&streetName={$street_endcode}&language=it-IT&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R";

        $response_json  =   file_get_contents($url);
        $responseData   =   json_decode($response_json, true);

        error_log(print_r($responseData, true));

        if (isset($responseData['results'][0]['position']['lat']) && isset($responseData['results'][0]['position']['lon'])) {

            $latitude = $responseData['results'][0]['position']['lat'];
            $longitude = $responseData['results'][0]['position']['lon'];

            $apartment->title        = $data['title'];
            $apartment->description  = $data['description'];
            $apartment->country      = $country;
            $apartment->street       = $data['street'];
            $apartment->latitude     = $latitude;
            $apartment->longitude    = $longitude;
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
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        // if ($apartment->cover) {
        //     Storage::delete($apartment->cover);
        // }

        $apartment->services()->detach();
        $apartment->sponsors()->detach();
        // $apartment->messages()->detach();

        $apartment->delete();

        return to_route('admin.apartments.index')->with('delete_success', $apartment);
    }
}