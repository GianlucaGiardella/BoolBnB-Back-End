<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $paymentMethod = "creditCard";
        $sponsorId = $request->input('sponsor_id');
        $sponsor = Sponsor::find($sponsorId);
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

            if ($apartment->sponsors()->where('valid', true)->count() > 0) {

                $apartment->sponsors()->where('valid', true)->update([
                    'end_date' => DB::raw('DATE_ADD(end_date, INTERVAL ' . $sponsor->duration . ' HOUR)'),
                ]);
                return view('admin.payment.already');
            } else { //se non esise una sponsorizzazione attiva
                $apartment->sponsors()->attach($sponsor->id, [
                    'start_date' => now()->addHours(2), // Imposta la data corrente
                    'end_date' => (now()->addHours(2 + $sponsor->duration)),
                ]);
            }

            return view('admin.payment.success');
        } else {
            // Pagamento fallito, mostra una vista di errore
            return view('admin.payment.error', ['errorMessage' => $result->message]);
        }
    }
}