<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;

class CelularesTablets extends Component
{
    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
        $this->emitTo('cart', 'addToCart');
    }

    public function render()
    {
        $celulares_tablets = Product::where("categorias_id","=",3)->get();
        return view('livewire.product.celulares-tablets', [
            'productos' => $celulares_tablets
        ]);
    }
}
