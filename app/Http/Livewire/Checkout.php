<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CartManager;
use Share;

class Checkout extends Component
{

    public $cart, $stripeKey;
    private $shareButtons1;

    public function mount(CartManager $cart)
    {
        $this->stripeKey = config('services.stripe.key');
        $this->cart = $cart->getCart();

        $this->shareButtons1 = Share::page(
            'https://tareaexaulacet115siman.herokuapp.com/','Ha realizado una compra en siman')
      ->facebook()
      ->twitter()
      ->linkedin()
      ->telegram()
      ->whatsapp() 
      ->reddit();
    }
    public function deleteProduct(CartManager $cart, $productId)
    {
        $cart->deleteProduct($productId);
        session()->flash('message', 'Producto removido');
        $this->emitTo('cart', 'addToCart');
    }

    public function hydrate()
    {
        $this->cart = (app(CartManager::class))->getCart();
    }

    public function render()
    {
        return view('livewire.checkout', [
            'products' => $this->cart->products
        ],['shareButtons1' => $this->shareButtons1])->extends('layouts.app');
    }
}
