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
        $productosRelacionadosP = Product::where("id","!=",$this->product->id)->where("categorias_id","=", $this->product->categorias_id)->first();
        //dd($productosRelacionadosP->id);
        if($productosRelacionadosP!=null){
            $productosRelacionados = Product::where("id","!=",$this->product->id)->where("id","!=",$productosRelacionadosP->id)->where("categorias_id","=", $this->product->categorias_id)->get();
            return view('livewire.product.show',['categoria' => $categoria, 'proveedor' => $proveedor, 'rel' => $productosRelacionados, 'relP' => $productosRelacionadosP])->extends('layouts.app');
        }
        $productosRelacionados = null;
        return view('livewire.product.show',['categoria' => $categoria, 'proveedor' => $proveedor, 'rel' => $productosRelacionados, 'relP' => $productosRelacionadosP])->extends('layouts.app');
    }
}
