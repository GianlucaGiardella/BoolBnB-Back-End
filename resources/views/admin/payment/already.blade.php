@extends('layouts.base')
@section('contents')
    <div class="my-3">
        <div class="row">
            <div class="card">
                <div class="card-body text-center">
                    <div class="fs-5 mt-2">Sponsorizzazione prolungata!</div>
                    <a href="{{ route('admin.apartments.index') }}"
                        class="text-decoration-none btn btn-info mt-3">Sponsorizza un altro Appartamento!</a>
                </div>
            </div>
        </div>
    </div>
@endsection