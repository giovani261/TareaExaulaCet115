<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductShoppingCart;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Auth;

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
        $ordenes=Order::all();
        $orden_filtrada=$ordenes->where('id', $id);

        $shop_cart=ShoppingCart::all();
        $shop_filtrada=$shop_cart->where('id', $orden_filtrada->get('shopping_cart_id'));

        $product_shopping=ProductShoppingCart::all();

        $product_shopping_filtrados=$product_shopping->
        where('shopping_cart_id', $shop_filtrada->get('id'));

        $productos=Product::all();

        foreach ($product_shopping_filtrados as $prod) {
            
            foreach($productos as $producto){

                if($prod->get('product_id')==$producto->get('id')){
                    $diccionario->append($producto->get('name'));           
                }
            }
           
        }



        return view("seguimientoOrden.detalle", ["orders" => $orden_filtrada],["products" => $diccionario]);
    }

    public function detalle2(Request $request)
    {
       
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
