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
            <div class="container d-flex flex-row justify-content-between">
                <button class="styled-btn">
                    <a class="nav-link" href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}">Modifica
                        Appartamento</a>
                </button>


                {{-- bottone sponsorizzazione --}}
                <div>
                    <button class="styled-btn">
                        <a class="nav-link" href="{{ route('admin.sponsor.index') }}">
                            Sponsorizza</a>
                    </button>
                </div>
                {{-- <div>
                    <button class="Btn">
                        <a href="http://{{ route('admin.sponsor.index') }}">Sponsorizza</a>

                        <svg class="svgIcon" viewBox="0 0 576 512">
                            <path
                                d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z">
                            </path>
                        </svg>
                    </button> 
                 </div> --}}
            </div>
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

        @forelse ($apartment->messages as $message)
            <div class="pb-4">
                <a class="d-inline-block" href="{{ route('admin.apartments.show', $message->apartment->id) }}"></a>
                <p>
                    email: {{ $message->email_sender }} >
                </p>
                <p class="ms_messageText">{{ $message->text_message }}</p>
                <div>{{ $message->created_at }}</div>
                <hr>
            </div>
        @empty
            Non ci sono messaggi!
        @endforelse
    </div>
    {{-- <style>
        .Btn {
            width: 130px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(15, 15, 15);
            border: none;
            color: white;
            font-weight: 600;
            gap: 8px;
            cursor: pointer;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.103);
            position: relative;
            overflow: hidden;
            transition-duration: .3s;
        }

        .svgIcon {
            width: 16px;
        }

        .svgIcon path {
            fill: white;
        }

        .Btn::before {
            width: 130px;
            height: 130px;
            position: absolute;
            content: "";
            background-color: white;
            border-radius: 50%;
            left: -100%;
            top: 0;
            transition-duration: .3s;
            mix-blend-mode: difference;
        }

        .Btn:hover::before {
            transition-duration: .3s;
            transform: translate(100%, -50%);
            border-radius: 0;
        }

        .Btn:active {
            transform: translate(5px, 5px);
            transition-duration: .3s;
        }

        a {
            list-style: none;
            text-decoration: none;
            color: white;
        }
    </style> --}}
@endsection
