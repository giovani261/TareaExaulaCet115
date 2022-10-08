
<div>
    @if (session()->has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" role="alert"> 
            {{ session('message') }}
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="container">
        <h2 class="text-center mb-4 mt-3">Resumen de compra</h2>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                    @if($product->pivot)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td><button class="btn btn-danger" wire:click="deleteProduct('{{ $product->pivot->id }}')">Eliminar</button></td>
                                        </tr>
                                    @endif
                                @endforeach

                                <tr>
                                    <th></th>
                                    <td class="font-weight-bold">Total</td>
                                    <td class="font-weight-bold">{{ $products->sum('price') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <center><h5><b>Metodos de pago</b></h5></center>
                <div class="card">
                    <div class="card-header">
                        <b><i class="fa-regular fa-credit-card"></i> Tarjeta de credito/debito</b> 
                    </div>
                    <div class="card-body">
                        @include('stripe.stripe')
                    </div>
                </div>
                <form action="{{ route('paypal.payment') }}">
                        <div class="card">
                            <div class="card-header">
                                <b><i class="fa-brands fa-cc-paypal"></i> Paypal</b>
                            </div>
                            <div class="card-body">
                                <center><button class="btn btn-outline-primary" type="submit">Pagar</button></center>
                            </div>
                        </div>
                </form>
                <form action="{{ route('crypto.payment') }}">
                        <div class="card">
                            <div class="card-header">
                                <b><i class="fa-brands fa-bitcoin"></i> <i class="fa-brands fa-ethereum"></i> Cryptomonedas</b>
                            </div>
                            <div class="card-body">
                                <center><button class="btn btn-outline-primary" type="submit">Pagar</button></center>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://js.stripe.com/v3/"></script> 

<script>
    var stripe = Stripe("{{ $stripeKey }}");
    var elements = stripe.elements();

    var card = elements.create('card', {
        hidePostalCode: true,
        style: {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                lineHeight: '40px',
                fontWeight: 300,
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSize: '15px',
                '::placeholder': {
                    color: '#CFD7E0',
                },
            }, 
        } 
    });

    card.mount('#card-element')

    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors')

        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    })

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }

</script>
@endpush