<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;

use App\Models\Payment;
use App\Models\Sponsor;
use App\Models\Apartment;
use Braintree\Transaction;
use Illuminate\Http\Request;
use App\Models\ApartmentSponsor;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class PaymentController extends Controller
{

    public function processPayment(Request $request)
    {

        $paymentMethod = "creditCard";
        $sponsorId = $request->input('sponsor_id');
        $sponsor = Sponsor::find($sponsorId);

        $sponsorId = $request->input('sponsor_id');
        $apartmentId = $request->input('apartment_id');
        $apartment = Apartment::find($apartmentId);
        $nonce = $request->payment_method_nonce;
        $price = $sponsor->price;


        // Effettua il pagamento utilizzando Braintree
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
        
        // Gestisci il pagamento in base al metodo selezionato
        if ($paymentMethod === 'creditCard') {
            // Elabora la transazione con carta di credito
            $result = $gateway->transaction()->sale([
                'amount' => $price,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true,
                ],
            ]);
        } elseif ($paymentMethod === 'paypal') {
            // Elabora la transazione con PayPal
            // Implementa la logica per il pagamento PayPal
        }

        // Gestisci la risposta di Braintree e restituisci una vista appropriata
        if ($result->success) {

            $durationInHours = $sponsor->duration;
            $endTime = now()->addHours($durationInHours);

            $apartment->sponsors()->attach($sponsorId, ['end_date' => $endTime, 'start_date' => now()]);


            return view('admin.payment.success');
        } else {
            // Pagamento fallito, mostra una vista di errore
            return view('admin.payment.error', ['errorMessage' => $result->message]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}