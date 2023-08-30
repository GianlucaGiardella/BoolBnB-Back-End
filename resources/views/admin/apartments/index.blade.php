@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $apartment = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Appartmento "{{ $apartment->title }}" eliminato
        </div>
    @endif

    <div class="card mt-3 p-2">
        <div class="card-body">
            <div class="d-inline-block">
                <h1 class="text-gradient">I tuoi appartamenti</h1>
                <hr class="rounded">
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-dark">Titolo</th>
                        <th scope="col" class="text-dark">Descrizione</th>
                        <th scope="col" class="text-dark">Metri Quadri</th>
                        <th scope="col" class="text-dark">Camere</th>
                        <th scope="col" class="text-dark">Letti</th>
                        <th scope="col" class="text-dark">Bagni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment->title }}</td>
                            <td>{{ $apartment->description }}</td>
                            <td>{{ $apartment->size }}</td>
                            <td>{{ $apartment->rooms }}</td>
                            <td>{{ $apartment->beds }}</td>
                            <td>{{ $apartment->bathrooms }}</td>
                            <td>
                                <a class="btn btn-outline-info"
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
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Sei sicuro ?</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action=""
                                        data-template="{{ route('admin.apartments.destroy', ['apartment' => '*****']) }}"
                                        method="post" class="d-inline-block" id="confirm-delete">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-apartment btn btn-primary">
                        <a class="nav-link" href="{{ route('admin.apartments.create') }}">Aggiungi Appartamento</a>
                    </div>
                </tbody>
            </table>

            {{ $apartments->links() }}
        </div>
    </div>
@endsection
