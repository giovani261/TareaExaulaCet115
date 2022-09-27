<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;

class Calzado extends Component
{
    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
        $this->emitTo('cart', 'addToCart');
    }

    public function render()
    {
        $calzado = Product::where("categorias_id","=",1)->get();
        return view('livewire.product.calzado', [
            'productos' => $calzado
        ]);
    }
}