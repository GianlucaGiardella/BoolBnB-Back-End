@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $apartment = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Appartmento "{{ $apartment->title }}" eliminato
        </div>
    @endif

    <div class="card mt-3 p-2">
        <div class="card-body d-flex flex-column gap-3 align-items-start">
            <div class="text-gradient">
                <h1 class="">Lista Appartamenti</h1>
                <hr class="m-0">
            </div>

            <button class="d-block styled-btn">
                <a class="nav-link" href="{{ route('admin.apartments.create') }}">Aggiungi Appartamento</a>
            </button>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-dark">Titolo</th>
                        <th scope="col" class="text-dark">Metri Quadrati</th>
                        <th scope="col" class="text-dark">Camere</th>
                        <th scope="col" class="text-dark">Bagni</th>
                        <th scope="col" class="text-dark">Letti</th>
                        <th scope="col" class="text-dark">Visibile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment->title }}</td>
                            <td>{{ $apartment->size }}</td>
                            <td>{{ $apartment->rooms }}</td>
                            <td>{{ $apartment->bathrooms }}</td>
                            <td>{{ $apartment->beds }}</td>
                            <td>{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                            <td>
                                <a class="btn btn-outline-info fs-6"
                                    href="{{ route('admin.apartments.show', ['apartment' => $apartment]) }}">&#8505;</a>
                                <a class="btn btn-outline-dark"
                                    href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}">✏️</a>
                                <button class="btn btn-outline-warning js-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $apartment->slug }}">&#128465;</button>
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
                                    <form action=""
                                        data-template="{{ route('admin.apartments.destroy', ['apartment' => '*****']) }}"
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

            {{ $apartments->links() }}
        </div>
    </div>
@endsection
