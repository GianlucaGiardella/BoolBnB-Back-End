@extends('layouts.base')

@section('contents')
    <div class="card box-shadow mt-0">
        <div class="card-body d-flex flex-column gap-3 py-3">

            {{-- Header --}}
            <div class="container">
                <div class="d-inline-block text-gradient">
                    <h1>Statistiche Appartamento</h1>
                </div>
                <hr class="m-0">
            </div>

            <div class="container-top">
                <p>In dettaglio tutte le visualizzazioni per ogni mese dell'anno</p>
            </div>
            <div class="container-canvas">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    'Gennaio',
                    'Febbraio',
                    'Marzo',
                    'Aprile',
                    'Maggio',
                    'Giugno',
                    'Luglio',
                    'Agosto',
                    'Settembre',
                    'Ottobre',
                    'Novembre',
                    'Dicembre',
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [3, 5, 2, 8, 10, 15, 19, 28, 17, 11, 7, 12],
                    backgroundColor: [
                        'red'
                    ],
                    borderColor: [
                        'black',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

<style>
    .container-top {
        display: flex;
        flex-direction: column;
        align-items: center
    }

    .container-canvas {
        display: flex;
        justify-content: center;
        padding-top: 3rem;
    }

    canvas {
        width: 75% !important;
        height: 75% !important;
    }
</style>
