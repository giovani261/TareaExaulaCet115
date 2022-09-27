<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;

class LaptopsComputadoras extends Component
{
    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
        $this->emitTo('cart', 'addToCart');
    }

    public function render()
    {
        $laptops_computadoras = Product::where("categorias_id","=",2)->get();
        return view('livewire.product.laptops-computadoras', [
            'productos' => $laptops_computadoras
        ]);
    }
}
