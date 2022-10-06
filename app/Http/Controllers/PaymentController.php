<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paypal;
use App\Models\CartManager;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge as ChargeCrypto;
use Auth;

class PaymentController extends Controller
{
    public function paypalPaymentRequest(CartManager $cart, Paypal $paypal)
    {
        return redirect()->away($paypal->paymentRequest($cart->getAmount()));
    }

    public function paypalCheckout(Request $request, CartManager $cart, Paypal $paypal, $status)
    {
        if ($status == "success") {
            $response = $paypal->checkout($request);

            if(!is_null($response)) {
                $response->shopping_cart_id = $cart->getCart()->id;
                Order::createFromResponse($response);
                session()->flash('message', 'Compra exitosa, hemos enviado un correo con un resumen de tu compra');
                return redirect()->route('welcome');
            }
        }
    }

    public function stripeCheckout(Request $request, CartManager $cart)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        Charge::create([
            'amount' => ($cart->getAmount()),
            'currency' => 'USD',
            'source' => $request->stripeToken
        ]);
        
        Order::create(['shopping_cart_id' => $cart->getCart()->id, 'email' => $request->email, 'total' => $cart->getAmount(), 'name' => Auth::user()->name, 'address_line_1' => Auth::user()->address_line_1]);

        session()->flash('message', 'Compra exitosa, hemos enviado un correo con un resumen de tu compra');
        return redirect()->route('welcome');
    }

    public function coinbaseCheckout(Request $request, CartManager $cart){
        ApiClient::init('284f335a-19fd-40db-b4d5-26f912440772'); //incializar el cliente mediante la api con la api key

        $cargo = new ChargeCrypto([
            'name' => 'Pago de los productos',
            'description' => 'Proyecto CET115',
            'pricing_type' => 'fixed_price',
            'local_price' => [
                'amount' => $cart->getAmount(),
                'currency' => 'USD'
            ],
            'metadata' => [
                'user_id' => Auth::user()->id,
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email
            ]
        ]);
        try{
            $cargo->save();
            //dd($cargo);
            return redirect($cargo->hosted_url);
            if(isset($cargo->payments[0]['status'])){
                if($cargo->payments[0]['status']=='CONFIRMED'){
                    session()->flash('alert-class', 'alert-success'); 
                    Order::create(['shopping_cart_id' => $cart->getCart()->id, 'email' => $request->email, 'total' => $cart->getAmount(), 'name' => Auth::user()->name, 'address_line_1' => Auth::user()->address_line_1]);
                    session()->flash('message', 'Compra exitosa, hemos enviado un correo con un resumen de tu compra');
                    return redirect()->route('checkout');
                }
            }

        }catch(\Exception $e){
            session()->flash('alert-class', 'alert-danger'); 
            session()->flash('message', 'No se pudo realizar la compra, ocurrio un error al procesar su pago');
            return redirect()->route('checkout');
        }
    }
}
