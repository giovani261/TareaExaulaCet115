<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;

class PantallasAudio extends Component
{
    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
        $this->emitTo('cart', 'addToCart');
    }

    public function render()
    {
        $pantallas_audio = Product::where("categorias_id","=",4)->get();
        return view('livewire.product.pantallas-audio', [
            'productos' => $pantallas_audio
        ]);
    }
}
