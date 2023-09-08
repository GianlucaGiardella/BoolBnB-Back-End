@extends('layouts.base')
@section('contents')
    <h1>Sponsorizzazione</h1>
    <p>Raggiungete un vasto pubblico per il vostro appartamento con una sponsorizzazione su misura! Offriamo una varietà di
        opzioni di sponsorizzazione, sia standard che personalizzate, per soddisfare al meglio le vostre esigenze. Scegliete
        la soluzione ideale per promuovere il vostro appartamento e attirare il massimo numero di potenziali clienti!</p>

    <div class="row">
        @foreach ($sponsors as $sponsor)
            <form id="payment-form" action="{{ route('admin.process_payment') }}" method="post"
                class="col-12 col-lg-6 mx-auto">
                @csrf
                <div class="card mb-3" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                    <div class="card-body">
                        <h2 class="card-title">Aquista una sponsorizzazione</h2>
                        <h5 class="card-title">{{ $sponsor->name }}</h5>
                        <p class="card-text">Durata {{ $sponsor->duration }}h</p>
                        <p class="card-text">Prezzo {{ $sponsor->price }}€</p>

                        {{-- Errore --}}
                        @error('sponsor_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
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
            </form>

            <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
            <script>
                var button = document.getElementById('submit-button');
                var form = document.querySelector('#payment-form');
                var client_token = "{{ $token }}";
                var paymentInstance;

                braintree.dropin.create({
                    authorization: client_token,
                    container: '#dropin-container'
                }, (createErr, instance) => {
                    if (createErr) {
                        console.error(createErr);
                        return;
                    }

                    form.addEventListener('submit', event => {
                        event.preventDefault();

                        instance.requestPaymentMethod((err, payload) => {
                            if (err) {
                                console.error(err);
                                return;
                            }

                            console.log(payload.nonce)
                            document.querySelector('#nonce').value = payload.nonce;
                            form.submit();
                        });
                    });
                });
            </script>
        @endforeach
    </div>
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