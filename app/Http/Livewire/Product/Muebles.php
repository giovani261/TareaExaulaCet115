<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;

class Muebles extends Component
{
    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
        $this->emitTo('cart', 'addToCart');
    }

    public function render()
    {
        $muebles = Product::where("categorias_id","=",5)->get();
        return view('livewire.product.muebles', [
            'productos' => $muebles
        ]);
    }
}
