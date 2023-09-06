<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Support\Str;
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

        // return view('admin.apartments.index', compact('apartments'));

        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.apartments.index', compact('apartments', 'messages'));
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
        //User Control
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        $services = Service::all();
        $sponsors = Sponsor::all();
        $messages = Message::all();

        if (Auth::id() !== $apartment->user_id) abort(403);

        return view('admin.apartments.edit', compact('apartment', 'services', 'messages'));
    }

    public function update(Request $request, $slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $apartment->user_id) abort(403);

        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

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

                // Verifica se esiste un'immagine all'indice $i
                $imageAtIndex = $apartment->images->get($i);

                if ($imageAtIndex) {
                    // Elimina l'immagine esistente
                    Storage::delete($imageAtIndex->img_url);

                    // Aggiorna l'URL dell'immagine
                    $imageAtIndex->img_url = $imagePath;
                    $imageAtIndex->save(); // Salva le modifiche all'immagine
                } else {
                    // Se non esiste un'immagine all'indice $i, crea una nuova immagine
                    $apartment->images()->create([
                        'apartment_id' => $apartment->id,
                        'img_url' => $imagePath
                    ]);
                }
            } else if (!$request->filled('old_image' . $i)) {
                // Verifica se esiste un'immagine all'indice $i
                $imageAtIndex = $apartment->images->get($i);

                if ($imageAtIndex) {
                    // Elimina l'immagine esistente
                    Storage::delete($imageAtIndex->img_url);

                    // Elimina l'immagine dal database
                    $imageAtIndex->delete();
                }
            }
        }

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
        if (Auth::id() !== $apartment->user_id) abort(403);

        $apartment->services()->detach();
        $apartment->sponsors()->detach();
        $apartment->messages()->delete();
        $apartment->views()->delete();

        if ($apartment->cover) {
            Storage::delete($apartment->cover);
        }

        foreach ($apartment->images as $image) {
            Storage::delete($image->img_url);
        }
        $apartment->images()->delete();

        $apartment->delete();

        return to_route('admin.apartments.index')->with('delete_success', $apartment);
    }

    public function message($id)
    {
        $messages = Message::where('apartment_id', $id)->get();
        return view('admin.apartments.message', compact('messages'));
    }
}