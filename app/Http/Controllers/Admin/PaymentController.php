<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $paymentMethod = "creditCard";
        $sponsorId = $request->input('sponsor_id');
        $apartmentId = $request->input('apartment_id');
    
        // Find the sponsor and apartment
        $sponsor = Sponsor::find($sponsorId);
        $apartment = Apartment::find($apartmentId);
        
        // Validate sponsor and apartment existence
        if (!$sponsor || !$apartment) {
            return response()->json(['message' => 'Sponsor or apartment not found'], 404);
        }
    
        $nonce = $request->payment_method_nonce;
        $price = $sponsor->price;
    
        // Effettua il pagamento utilizzando Braintree
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
    
        $token = $gateway->clientToken()->generate();
    
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
            // Implement PayPal payment processing logic here
            // You will need to create a PayPal payment request and handle the callback as mentioned in previous responses.
        }
    
        // Gestisci la risposta di Braintree e restituisci una vista appropriata
        if ($result->success) {
            $durationInHours = $sponsor->duration;
            $endTime = now()->addHours($durationInHours);
    
            $apartment->sponsors()->attach($sponsor->id, ['end_time' => $endTime, 'start_time' => now()]);
    
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
}
