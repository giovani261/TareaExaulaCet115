
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
                <div class="card">
                    <div class="card-header">
                        <b><i class="fa-brands fa-bitcoin"></i> <i class="fa-brands fa-ethereum"></i> Cryptomonedas</b>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('crypto.payment') }}">
                        <center><button class="btn btn-outline-primary" type="submit">Pagar con Coinbase</button></center>
                    </form>
                    <form id="cryptocomForm" name="cryptocomForm" action="{{ route('crypto.cryptocom.payment') }}">
                        @guest
                            <br>
                            <center><h3>Inicie sesion para poder pagar con crypto.com</h3></center>
                            <center><img class="img-thumbnail" src="/imgs/crypto.comPay.png" alt="assd" style="height:50px; width:230px;"></center>
                        @else
                        <br>
                        <center><div id="pay-button"></div></center>
                        @endguest
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>

     <style>
     #social-links ul{
          padding-left: 0;
     }
     #social-links ul li {
          display: inline-block;
     } 
     #social-links ul li a {
          padding: 6px;
          border: 1px solid #ccc;
          border-radius: 5px;
          margin: 1px;
          font-size: 25px;
     }
     #social-links .fa-facebook{
           color: #0d6efd;
     }
     #social-links .fa-twitter{
           color: deepskyblue;
     }
     #social-links .fa-linkedin{
           color: #0e76a8;
     }
     #social-links .fa-whatsapp{
          color: #25D366
     }
     #social-links .fa-reddit{
          color: #FF4500;;
     }
     #social-links .fa-telegram{
          color: #0088cc;
     }
     </style>

<div class='container'>

<!-- Post 1 -->
<div class='row mt-5'>
      <h2>Compartir en redes sociales</h2>

      <!-- Social Share buttons 1 -->
      <div class="social-btn-sp">
            {!! $shareButtons1 !!}
      </div> 
 </div>
 </div>
</div>
@push('scripts')
<script src="https://js.crypto.com/sdk?publishable-key=pk_test_pQc3wFfS5sFXXoBzfGo1sbQN"></script>
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

<script>
    cryptopay.Button({
      createPayment: function(actions) {
        return actions.payment.create({
          currency: 'USD',
          amount: {{ $products->sum('price') }}*100,
          description : 'Compra de productos',
          @if(!Auth::guest())  
          metadata: {
            total: {{ $products->sum('price') }},
            nombre_usuario: "{{ Auth::user()->name }}",
            correo_usuario: "{{ Auth::user()->email }}",
            residencia: "{{ Auth::user()->address_line_1 }}",
          }
          @endif
        });
      },
      onApprove: function (data, actions) {
        // Optional: add logic such as browser redirection or check data object content
        document.getElementById("cryptocomForm").submit();
      },
      defaultLang: 'es-ES' // Optional: default language for payment page
    }).render("#pay-button")
  </script>


@endpush