@extends('layouts.base')
@section('contents')
    <h1>Sponsorizzazione</h1>
    <p>Raggiungete un vasto pubblico per il vostro appartamento con una sponsorizzazione su misura! Offriamo una varietà di
        opzioni di sponsorizzazione, sia standard che personalizzate, per soddisfare al meglio le vostre esigenze. Scegliete
        la soluzione ideale per promuovere il vostro appartamento e attirare il massimo numero di potenziali clienti!</p>
    <div class="container d-flex justify-content-between">
        @foreach ($sponsors as $sponsor)
            {{-- @php dd($apartment) @endphp --}}
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $sponsor->name }}</h5>
                    <p class="card-text">Durata {{ $sponsor->duration }}h</p>
                    <p class="card-text">Prezzo {{ $sponsor->price }}€</p>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        data-sponsor-id="{{ $sponsor }}" data-apartment-id="{{ $apartment }}">
                        Compra
                    </button>

                    {{-- Modal --}}
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
                                    <div id="dropin-container" name="payment_method_nonce" class="payment-method-nonce">
                                    </div>
                                    <button id="submit-button" class="button button--small button--green">Purchase</button>

                                    <script>
                                        var button = document.querySelector('#submit-button');
                                        let sponsorId = button.getAttribute('data-sponsor-id');
                                        let apartmentId = button.getAttribute('data-apartment-id');


                                        braintree.dropin.create({
                                            authorization: '{{ $token }}',
                                            container: '#dropin-container'
                                        }, function(createErr, instance) {
                                            button.addEventListener('click', function() {
                                                instance.requestPaymentMethod(function(err, payload) {
                                                    if (err) {
                                                        console.error(err);
                                                        return;
                                                    }
                                                    // Make the payment processing request with Axios
                                                    axios.post('admin/processPayment', {
                                                            payload: payload,
                                                            sponsor_id: sponsorId,
                                                            apartment_id: apartmentId
                                                        })
                                                        .then(function(response) {
                                                            if (response.data.success) {
                                                                console.log('Payment successful!');
                                                            } else {
                                                                console.log('Payment failed');
                                                            }
                                                        })
                                                        .catch(function(error) {
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
