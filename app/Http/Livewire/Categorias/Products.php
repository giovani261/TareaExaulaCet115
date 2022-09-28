<?php

namespace App\Http\Livewire\Categorias;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;
use App\Models\Categorias;
use App\Models\Proveedores;

class Products extends Component
{
    public $categoria_id;
    

    public function addToCart(CartManager $cart, $slug)
    {
        $cart->addToCart($slug);
        session()->flash('message', 'Producto agregado al carrito de compras');
    }

     public function mount()
     {
        $this->categoria_id=request('categoria_id');
     }

    public function render()
    {           
        $products = Product::where("categorias_id","=", $this->categoria_id)->get();

        return view('livewire.categorias.products',['productos' => $products])->extends('layouts.app');
    }
}