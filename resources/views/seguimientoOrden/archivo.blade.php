@extends('layouts.app')


@section('content')
    
    <br>
    <div>
        <h3 style="padding-left:310px"><b>Tus Pedidos ARCHIVADOS</b></h3>
        
        <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>$ {{$order->total}}</td>
                        <td>
                            @if ($order->status==0)
                                    Confirmado
                            @elseif ($order->status==1)
                                    Pago Aprobado
                            @elseif ($order->status==2)
                                    Pedido Preparado
                            @elseif ($order->status==3)
                                    Enviando Pedido
                            @elseif ($order->status==4)
                                    Entregado
                            @elseif ($order->status==5)
                                    Pedido Cancelado
                            @else
                                    Pedido Inconcluso
                            @endif
                            
                        </td>
                        <td><a href="{{route("ordenes.detalle",[$order->id])}}">Ver detalles</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        
    </div>
    <br>




@endsection


