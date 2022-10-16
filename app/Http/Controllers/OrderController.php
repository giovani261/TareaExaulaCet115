<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductShoppingCart;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Collection;

class OrderController extends Controller
{

    public function index()
    {
        $email = Auth::user()->email;
        $ordenes=Order::all();

        $ordenes_filtradas=$ordenes->where('email', $email);

        return view("seguimientoOrden.index", ["orders"=>$ordenes_filtradas]); 
    }


    public function detalle($id)
    {
        $orden_filtrada=Order::where('id',$id)->get();
        
        $shop_filt=ShoppingCart::where('id',$orden_filtrada->pluck('shopping_cart_id'))->get();

        $product_shop_filt=ProductShoppingCart::where('shopping_cart_id',$shop_filt->pluck('id'))->get();

        $productos=Product::all();

        $diccionario = collect([]);

        foreach ($product_shop_filt as $prod) {
            
            foreach($productos as $producto){
                
                if($producto->id == $prod->product_id){ 
                    $diccionario->push($producto);
                }
            }
            
           
        }

        return view("seguimientoOrden.detalle", ["orders" => $orden_filtrada],["products" => $diccionario]);
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
