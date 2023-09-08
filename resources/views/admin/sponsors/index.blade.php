@extends('layouts.base')
@section('contents')
    <h1>Sponsorizzazione</h1>
    <p>Raggiungete un vasto pubblico per il vostro appartamento con una sponsorizzazione su misura! Offriamo una varietà di
        opzioni di sponsorizzazione, sia standard che personalizzate, per soddisfare al meglio le vostre esigenze. Scegliete
        la soluzione ideale per promuovere il vostro appartamento e attirare il massimo numero di potenziali clienti!</p>
    {{-- <div class="container d-flex justify-content-between">

        @foreach ($sponsors as $sponsor)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $sponsor->name }}</h5>
                    <p class="card-text">Durata {{ $sponsor->duration }}h</p>
                    <p class="card-text">Prezzo {{ $sponsor->price }}€</p>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-sponsor-id="{{ $sponsor->id }}" data-apartment-id="{{ $apartment->id }}"> 
                        Compra
                    </button>

                    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pagamento
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                    <script src="https://js.braintreegateway.com/web/dropin/1.40.2/js/dropin.js"></script>
                                    @csrf
                                    <div id="dropin-container" name="payment_method_nonce" class="payment-method-nonce"></div>
                                    <button id="submit-button" class="button button--small button--green">Purchase</button>
                                    
                                    <script>
                                        var button = document.querySelector('#submit-button');
                                        let sponsorId = button.getAttribute('data-sponsor-id');
                                        let apartmentId = button.getAttribute('data-apartment-id');
                                        

                                        braintree.dropin.create({
                                            authorization: '{{ $token }}',
                                            container: '#dropin-container'
                                        }, function (createErr, instance) {
                                            button.addEventListener('click', function () {
                                                instance.requestPaymentMethod(function (err, payload) {
                                                    if (err) {
                                                        console.error(err);
                                                        return;
                                                    }
                                                    let data = {
                                                        sponsor_id: sponsorId,
                                                        apartment_id: apartmentId,
                                                        payload: payload,
                                                    }
                                           
                                                    axios.post('{{ route('admin.payment.processPayment') }}', data)
                                                        .then(function (response) {
                                                            if (response.data.success) {
                                                                console.log('Payment successful!');
                                                            } else {
                                                                console.log('Payment failed');
                                                            }
                                                        })
                                                        .catch(function (error) {
                                                            console.error(error);
                                                            alert('Payment failed');
                                                        });
                                                });
                                            });
                                        });
                                    </script>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div> --}}


    <div class="row">
        <form id="payment-form" action="{{ route('admin.process_payment') }}" method="post" class="col-12 col-lg-6 mx-auto">
            @csrf
            <div class="card mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body">
                    <h2 class="card-title">Aquista una sponsorizzazione</h2>
                    <div class="form-group">
                        <label for="sponsor_id">Scegli un pacchetto:</label><br>
                        @foreach ($sponsors as $sponsor)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sponsor_id"
                                    id="sponsor_{{ $sponsor->id }}" value="{{ $sponsor->id }}" required>
                                <label class="form-check-label" for="sponsor_{{ $sponsor->id }}">
                                    {{ $sponsor->name }} (Prezzo: {{ $sponsor->price }}€, Durata: {{ $sponsor->duration }}
                                    ore)
                                </label>
                            </div>
                        @endforeach

                        {{-- Errore --}}
                        @error('sponsor_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="apartment_id">Scegli un appartamento:</label>
                        <select name="apartment_id" id="apartment_id" class="form-control" required>
                            <option value="">Scegli un appartamento</option>
                            @foreach ($apartments as $apartment)
                                <option value="{{ $apartment->id }}">
                                    {{ $apartment->title }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Errore --}}
                        @error('apartment_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="dropin-wrapper" class="mt-3">
                        <div id="checkout-message"></div>
                        <div id="dropin-container"></div>
                        <input id="nonce" name="payment_method_nonce" type="hidden" required />
                        <button id="submit-button" class="btn btn-primary btn-block">Paga</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var button = document.getElementById('submit-button');
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        var paymentInstance;

        braintree.dropin.create({
            authorization: client_token,
            container: '#dropin-container'
        }, function(createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    console.log(payload.nonce)
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });

            //paymentInstance = instance;
        });
    </script>
@endsection

<style>
    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: #64d18a;
        border-color: #64d18a;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: #8bdda8;
        color: white;
    }
</style>
