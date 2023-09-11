@extends('layouts.base')

@section('contents')
<img src="../storage/img/dashbord.jpg" alt="montagna" class="img-bg">
    <div class="dash-container">
        <h1 class="text-gradient">Benvenuto!</h1>
        <a class="styled-btn px-3 py-1 dash-btn" href="{{ route('admin.apartments.index') }}">
            Vedi i tuoi appartamenti</a>
    </div>



@endsection

<style scoped lang="scss">

</style>