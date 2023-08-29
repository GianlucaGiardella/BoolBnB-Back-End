<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    private $validations = [
        'title'                 => 'required|string|min:5|max:80',
        'description'           => 'required|string',
        'price'                 => 'required|integer',
        'rooms'                 => 'required|integer|min:1|max:99',
        'beds'                  => 'required|integer|min:1|max:99',
        'bathrooms'             => 'required|integer|min:1|max:99',
        'cover'                 => 'nullable|image|max:1024',
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

        return view('admin.apartments.create', compact('apartments'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $newApartment               = new Apartment();

        $newApartment->user_id      = Auth::id();
        $newApartment->title        = $data['title'];
        $newApartment->slug         = Apartment::slugger($data['title']);
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

        if (Auth::id() !== $apartment->user_id) abort(403);

        return view('admin.apartments.edit', compact('apartment'));
    }

    public function update(Request $request, $slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $apartment->title        = $data['title'];
        $apartment->description  = $data['description'];
        $apartment->price        = $data['price'];
        $apartment->latitude     = $data['latitude'];
        $apartment->longitude    = $data['longitude'];
        $apartment->size         = $data['size'];
        $apartment->rooms        = $data['rooms'];
        $apartment->beds         = $data['beds'];
        $apartment->bathrooms    = $data['bathrooms'];
        $apartment->visibility   = $data['visibility'];

        if ($data['cover']) {
            $coverPath = Storage::put('uploads', $data['cover']);

            if ($apartment->cover) {
                Storage::delete($apartment->cover);
            }

            $apartment->cover = $coverPath;
        }

        $apartment->update();

        return to_route('admin.apartments.index');
    }

    public function destroy($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        if ($apartment->cover) {
            Storage::delete($apartment->cover);
        }

        $apartment->delete();

        return to_route('admin.apartments.index')->with('delete_success', $apartment);
    }
}