@extends('layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $apartment = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Appartmento "{{ $apartment->title }}" eliminato
        </div>
    @endif

    <div class="card mt-3 box-shadow">

        {{-- Header --}}
        <div class="card-header">
            <div class="row row-cols-1 row-cols-md-2 align-center g-3">
                <div class="">
                    <h1 class="text-gradient mb-0 p-2">Lista Appartamenti</h1>
                </div>

                <div class="d-flex add-container">
                    <a class="nav-link p-2" href="{{ route('admin.apartments.create') }}">
                        <button class="styled-btn"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
                    </a>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body d-flex flex-column gap-3 align-items-start">

            {{-- Table --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        {{-- <th scope="col" class="text-gradient">#</th> --}}
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0">Titolo</span>
                        </th>
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0">Dimensioni</span>
                        </th>
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0">Camere</span>
                        </th>
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0">Letti</span>
                        </th>
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0">Bagni</span>
                        </th>
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0">Visibile</span>
                        </th>
                        <th scope="col" class="text-gradient">
                            <span class="index-table-label mb-0"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            {{-- <td data-label="Id">{{ $loop->index + 1 }}</td> --}}
                            <td data-label="Titolo">{{ $apartment->title }}</td>
                            <td data-label="Dimensioni">{{ $apartment->size }}</td>
                            <td data-label="Camere">{{ $apartment->rooms }}</td>
                            <td data-label="Letti">{{ $apartment->beds }}</td>
                            <td data-label="Bagni">{{ $apartment->bathrooms }}</td>
                            <td data-label="Visibile">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                            <td>
                                <a class="btn btn-secondary"
                                    href="{{ route('admin.apartments.show', ['apartment' => $apartment]) }}"><i
                                        class="fa-solid fa-circle-info" style="color: #fff;"></i></a>
                                <a class="btn btn-primary"
                                    href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}"><i
                                        class="fa-solid fa-pen" style="color: #fff;"></i></a>
                                <button class="btn btn-danger js-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $apartment->slug }}"><i
                                        class="fa-solid fa-trash" style="color: #fff;"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    {{-- Delete modal --}}
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
    .card-header {
        background-color: #fff !important;
    }

    table {
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    .table> :not(caption)>*>* {
        padding: 0.8rem 0.5rem;
    }

    table th,
    table td {
        vertical-align: middle;
    }

    table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .add-container {
        justify-content: flex-end;
    }

    @media screen and (max-width: 991px) {
        .index-table-label {
            font-size: 10px;
            font-weight: 900;
        }
    }

    @media screen and (max-width: 767px) {
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

        .add-container {
            justify-content: flex-start;
        }
    }
</style>
