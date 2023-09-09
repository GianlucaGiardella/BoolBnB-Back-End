@extends('layouts.base')

@section('contents')
    <div class="card mt-0 box-shadow">
        <div class="card-body py-3">
            <div class="row">
                <div class="text-center">
                    <div class="fs-5 mt-2">Sponsorizzazione prolungata!</div>
                    <a href="{{ route('admin.apartments.index') }}" class="text-decoration-none btn btn-info mt-3">Sponsorizza
                        un altro Appartamento!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
