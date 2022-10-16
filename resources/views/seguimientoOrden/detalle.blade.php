@extends('layouts.app')


@section('content')
    
    <br>
    <div>
        <h3 style="padding-left:310px"><b>Detalle de tu pedido </b></h3>
        
        <table class="table-bordered table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>E-Mail</th>
                    <th>Direccion</th>
                    <th>Fecha Orden</th>
                    <th>Modificado</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>$ {{$order->total}}</td>
                        <td>{{$order->email}}</td>
                        <td>
                            {{$order->address_line_1}}<br>
                            {{$order->address_line_2}}<br>
                            {{$order->country_code}} {{$order->postal_code}}<br>
                        </td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        
           
       
        
    </div>



    <div>
        <hr>
        <h3>Estado del pedido</h3>

            @if ($order->status==0)
                Pedido Confirmado: Tu pedido fue registrado exitosamente en la página.
            @elseif ($order->status==1)
                Pago Aprobado: El pago de tu pedido fue autorizado.
            @elseif ($order->status==2)
                Pedido Preparado: Tu pedido ya fue preparado y está listo para ser despachado.
            @elseif ($order->status==3)
                Enviando Pedido: ¡Tu pedido ya está en camino!
            @elseif ($order->status==4)
                Entregado: Tu pedido ya ha sido entregado.
            @elseif ($order->status==5)
                Pedido Cancelado: El pedido fue cancelado.
            @else
                Pedido Inconcluso: Hubo algun inconveniente al entregar el paquete. Ponte en contacto con el vendedor para obtener mas informacion.
            @endif

        <hr>
    </div>



    <div>
        <h3>Detalle de los productos</h3>
    <table class="table-bordered table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>SubTotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><a href="{{route("products.show",[$product->slug])}}">{{$product->name}}</a></td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        
    </div>
    <br>




@endsection


