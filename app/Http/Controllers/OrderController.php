<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductShoppingCart;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Collection;

class OrderController extends Controller
{

    public function index()
    {
        $email = Auth::user()->email;
        
       $ordenes= DB::table('orders')
    ->where('email', $email)
    ->where('archivo', 0)->get();

        return view("seguimientoOrden.index", ["orders"=>$ordenes]); 
    }

    public function archivo()
    {
        $email = Auth::user()->email;
        
       $ordenes= DB::table('orders')
    ->where('email', $email)
    ->where('archivo', 1)->get();

        return view("seguimientoOrden.archivo", ["orders"=>$ordenes]); 
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

    public function indexAdmin()
    {
        $ordenes=Order::all();

        return view("seguimientoOrden.indexAdmin", ["orders"=>$ordenes]); 
    }

    public function detalleAdmin($id)
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

        return view("seguimientoOrden.detalleAdmin", ["orders" => $orden_filtrada],["products" => $diccionario]);
    }

    public function cambiarEstado($id,$par)
    {
        
        DB::table('orders')
    ->where('id', $id)
    ->update(['status' => $par]);

        return redirect()->route('ordenes.detalleAdmin', [$id]);
    }

    public function archivar($id)
    {
        
        DB::table('orders')
    ->where('id', $id)
    ->update(['archivo' => 1]);

        return redirect()->route('ordenes.index');
    }


}
