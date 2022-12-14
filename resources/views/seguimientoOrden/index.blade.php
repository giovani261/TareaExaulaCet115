@extends('layouts.app')


@section('content')
    
    <br>
    <div>
        <h3 style="padding-left:310px"><b>Tus Pedidos</b></h3>
        <a class='btn btn-primary' href="{{route("ordenes.archivo")}}">Ver pedidos archivados</a>
        
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
                                Aprobado
                            @elseif ($order->status==2)
                                Preparado
                            @elseif ($order->status==3)
                                Enviado
                            @elseif ($order->status==4)
                                Entregado
                            @elseif ($order->status==5)
                                Cancelado
                            @else
                                Inconcluso
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


