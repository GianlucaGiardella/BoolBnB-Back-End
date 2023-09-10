@extends('layouts.base')

@section('contents')
    <div class="card mt-0 box-shadow">
        <div class="card-body d-flex flex-column gap-3 py-3">

            <div class="container">
                <div class="text-center">
                    <div class="fs-5 mt-2">Sponsorizzazione prolungata!</div>
                    <a href="{{ route('admin.apartments.index') }}"
                        class="text-decoration-none btn btn-success mt-3">Sponsorizza
                        un altro Appartamento!</a>
                </div>
            </div>

        </div>
    </div>
@endsection
