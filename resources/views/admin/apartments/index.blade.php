@extends('layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $apartment = session('delete_success') @endphp
        <div class="alert alert-danger mt-3">
            Appartmento "{{ $apartment->title }}" eliminato
        </div>
    @endif

    <div class="card mt-0 box-shadow">
        <div class="card-body d-flex flex-column gap-3 py-3">

            {{-- Header --}}
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 align-center g-3 pb-3">
                    <div class="d-inline-block">
                        <h1 class="text-gradient m-0">Lista Appartamenti</h1>
                    </div>

                    <div class="d-flex add-container">
                        <a class="" href="{{ route('admin.apartments.create') }}">
                            <button class="styled-btn">
                                <i class="fa-solid fa-house-medical"></i>
                                Aggiungi
                            </button>
                        </a>
                    </div>

                </div>
                <hr class="m-0">
            </div>

            {{-- Body --}}
            <div class="container">
                @if (count($apartments))
                    <div class="d-flex gap-3 p-3">

                        @foreach ($apartments as $apartment)
                            <div class="card-apartments card">
                                <img class="img-card" src="{{ asset('storage/' . $apartment->cover) }}"
                                    alt="{{ $apartment->title }}">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                                <div class="container-btn">
                                    <a class="btn btn-secondary"
                                        href="{{ route('admin.apartments.show', ['apartment' => $apartment]) }}">
                                        <i class="fa-solid fa-circle-info" style="color: #fff;"></i>
                                    </a>
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}">
                                        <i class="fa-solid fa-pen" style="color: #fff;"></i>
                                    </a>
                                    <a class="btn btn-success"
                                        href="{{ route('admin.stats.index', ['apartment' => $apartment]) }}">
                                        <i class="fa-solid fa-chart-line" style="color: #fff;"></i>
                                    </a>
                                    <button class="btn btn-danger js-delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $apartment->slug }}">
                                        <i class="fa-solid fa-trash" style="color: #fff;"></i>
                                    </button>
                                </div>
                            </div>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla
                                        </button>
                                        <form
                                            data-template="{{ route('admin.apartments.destroy', ['apartment' => '*****']) }}"
                                            method="post" class="d-inline-block" id="confirm-delete">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="d-flex">
                        <h3>Attualmente non disponi di appartamenti</h3>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            <div class="container">
                {{ $apartments->links() }}
            </div>

        </div>
    </div>
@endsection

<style>
    .add-container {
        justify-content: flex-end;
    }

    .card-apartments {
        width: 260px;
        height: 240px;
    }

    .img-card {
        width: 100%;
        height: 80%;
        object-fit: cover;
    }

    .card-title {
        display: flex;
        justify-content: center;
        padding-top: 1rem;
        font-size: 1rem;
        white-space: nowrap;
    }

    .container-btn {
        display: flex;
        justify-content: center;
        gap: .3rem;
        margin-top: auto;
        padding-bottom: .5rem;
    }

    @media (max-width: 1200px) {
        .d-flex.gap-3.p-3 {
            flex-wrap: wrap;
            justify-content: center
        }
    }

    @media (max-width: 767px) {
        .add-container {
            justify-content: start;
        }
    }
</style>
