<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;
use App\Models\Categorias;
use App\Models\Proveedores;

class Show extends Component
{
    public $product;

    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $categoria = Categorias::where("id","=",$this->product->categorias_id)->get();
        $proveedor = Proveedores::where("id","=",$this->product->proveedores_id)->get();
        return view('livewire.product.show',['categoria' => $categoria], ['proveedor' => $proveedor])->extends('layouts.app');
    }
}
