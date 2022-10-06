<h1>Hola {{ auth()->user()->name }}</h1>

<h2>Gracias por comprar productos con nosotros</h2>

<h2>Su orden fue:</h2>
<table>
    <thead>
        <tr>
            <th scope="col" style="text-align:center;">Id de producto</th>
            <th scope="col" style="text-align:center;">Nombre</th>
            <th scope="col" style="text-align:center; padding-left:70px;">Precio</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->shoppingCart->products as $product)
            <tr>
                <td style="text-align:center;">{{ $product->id }}</td>
                <td style="text-align:center;">{{ $product->name }}</td>
                <td style="text-align:center; padding-left:70px;">${{ $product->price }}</td>
            </tr>
        @endforeach
        <br>
        <tr>
            <td class="font-weight-bold">Por un total de: ${{ $order->total }}</td>
            <!-- <td class="font-weight-bold">{{ $order->total }}</td> -->
        </tr>
        <tr>
            <td class="font-weight-bold">Su orden sera enviada a: {{ auth()->user()->address_line_1 }}</td>
        </tr>
    </tbody>
</table>
<!-- @isset($url)
    <h2>Para completar tu order, completa el siguiente formulario</h2>
    <a href="{{ $url }}">Formulario</a>
@endisset -->