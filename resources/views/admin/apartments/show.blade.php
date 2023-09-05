@extends('admin.layouts.base')

@section('contents')
    {{-- <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
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
    </table> --}}
    <div class="card mt-3 p-2">
        <div class="card-body d-flex flex-column gap-3 align-items-start">
            <div class="text-gradient">
                <h1 class="">{{ $apartment->title }}</h1>
                <hr class="m-0">
            </div>

            <button class="styled-btn">
                <a class="nav-link" href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}">Modifica
                    Appartamento</a>
            </button>

            <div>

            </div>

            <div class="">
                <h4 class="">Description</h4>
                <p>{{ $apartment->description }}</p>
            </div>

            <div class="mt-4">
                <h4 class="">Servizi</h4>
                <p>
                    @foreach ($apartment->services as $service)
                        {{ $service->name }}
                        {{ !$loop->last ? '|' : '' }}
                    @endforeach
                </p>
            </div>

            <div>
                <h5>Via: {{ $apartment->street }}</h5>
                <h5>Metri Quadrati: {{ $apartment->size }}</h5>
                <h5>Camere: {{ $apartment->rooms }}</h5>
                <h5>Letti: {{ $apartment->beds }}</h5>
                <h5>Bagni: {{ $apartment->bathrooms }}</h5>
            </div>
        </div>
        @forelse ($apartment->messages as $message)
        <div class="pb-4">
            <a class="d-inline-block" href="{{ route('admin.apartments.show', $message->apartment->id) }}"></a>
                <p>
                    email: {{$message->email_sender}} >
                </p>
                <p class="ms_messageText">{{ $message->text_message }}</p>
                <div>{{ $message->created_at }}</div>
            <hr>
        </div>
            @empty
                Non ci sono messaggi!
            @endforelse    
    </div>
@endsection
