@extends('admin.layouts.base')

@section('contents')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">price</th>
                <th scope="col">size</th>
                <th scope="col">rooms</th>
                <th scope="col">beds</th>
                <th scope="col">bathrooms</th>
                <th scope="col">visibility</th>
                <th scope="col">cover</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $apartment->title }}</th>
                <td>{{ $apartment->description }}</td>
                <td>{{ $apartment->price }}</td>
                <td>{{ $apartment->size }}</td>
                <td>{{ $apartment->rooms }}</td>
                <td>{{ $apartment->beds }}</td>
                <td>{{ $apartment->bathrooms }}</td>
                <td>{{ $apartment->visibility }}</td>
                <td>{{ $apartment->cover }}</td>
                <td>
                    @foreach ($apartment->services as $service)
                <td>{{ $service->name }}</td>
                @endforeach
                </td>

            </tr>
        </tbody>
    </table>
@endsection

Titolo
descrizione
Prezzo
Camere
bagni
metriquadri
Letti
visibilità
img di copertina
