@extends('layouts.app')


@section('content')
    
    <br>
    <div>
        <h3 style="padding-left:310px"><b>Tus Pedidos</b></h3>
        
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
                        <td>{{$order->total}}</td>
                        <td>{{$order->estado}}</td>
                        <td><a href="{{route("ordenes.detalle",[$order->id])}}">Ver detalles</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        
    </div>
    <br>




@endsection


