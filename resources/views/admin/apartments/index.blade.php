@extends('layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $apartment = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Appartmento "{{ $apartment->title }}" eliminato
        </div>
    @endif

    <div class="card mt-3 p-2">
        <div class="card-body d-flex flex-column gap-3 align-items-start">

            <div class="w-100 row row-cols-1 row-cols-md-2 justify-content-between align-center">
                <div class="text-gradient">
                    <h1 class="">Lista Appartamenti</h1>
                    <hr class="m-0">
                </div>

                <div class="d-flex justify-content-end">
                    <a class="nav-link" href="{{ route('admin.apartments.create') }}">
                        <button class="d-block styled-btn">Aggiungi Appartamento</button>
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-gradient">#</th>
                        <th scope="col" class="text-gradient">Titolo</th>
                        <th scope="col" class="text-gradient">Paese</th>
                        <th scope="col" class="text-gradient">Metri Quadrati</th>
                        <th scope="col" class="text-gradient">Camere</th>
                        <th scope="col" class="text-gradient">Letti</th>
                        <th scope="col" class="text-gradient">Bagni</th>
                        <th scope="col" class="text-gradient">Visibile</th>
                        <th scope="col" class="text-gradient"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td data-label="Id">{{ $loop->index + 1 }}</td>
                            <td data-label="Titolo">{{ $apartment->title }}</td>
                            <td data-label="Paese">{{ $apartment->country }}</td>
                            <td data-label="Metri Quadrati">{{ $apartment->size }}</td>
                            <td data-label="Camere">{{ $apartment->rooms }}</td>
                            <td data-label="Letti">{{ $apartment->beds }}</td>
                            <td data-label="Bagni">{{ $apartment->bathrooms }}</td>
                            <td data-label="Visibile">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                            <td>
                                <a class="btn btn-secondary"
                                    href="{{ route('admin.apartments.show', ['apartment' => $apartment]) }}"><i
                                        class="fa-solid fa-info" style="color: #ffffff;"></i></a>
                                <a class="btn btn-primary"
                                    href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}"><i
                                        class="fa-solid fa-pen" style="color: #ffffff;"></i></a>
                                <button class="btn btn-danger js-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $apartment->slug }}"><i
                                        class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Conferma eliminazione
                                    </h1>
                                </div>
                                <div class="modal-footer">
                                    <form data-template="{{ route('admin.apartments.destroy', ['apartment' => '*****']) }}"
                                        method="post" class="d-inline-block" id="confirm-delete">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Elimina</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annulla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="container">
                {{ $apartments->links() }}
            </div>

        </div>
    </div>
@endsection

<style>
    table {
        /* border: 1px solid #ccc; */
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }

    table tr {
        background-color: #f8f8f8;
        /* border: 1px solid #ddd; */
        padding: .35em;
    }

    table th,
    table td {
        padding: .625em;
        text-align: center;
    }

    table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td::before {
            /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
            background: #424172;
            background: repeating-radial-gradient(circle farthest-corner at top left, #424172 0%, #FF7210 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }














    /* general styling */
    body {
        line-height: 1.25;
    }
</style>
