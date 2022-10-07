<div>
    <div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('imgs/carrousel1.png') }}" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('imgs/carrousel2.png') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('imgs/carrousel3.png') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br>
    <center>
        <div class="row">
            <div class="col-sm">
                <div class="card" style="width: 11rem;">
                    <div class="card-body">
                        <a><i class="fa-solid fa-shield"></i> Compra segura</a> 
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 12rem;">
                    <div class="card-body">
                        <a><i class="fa-solid fa-headset"></i> Atencion al cliente</a> 
                    </div>
                </div>           
            </div>
            <div class="col-sm">
                <div class="card" style="width: 11rem;">
                    <div class="card-body">
                        <a><i class="fa-solid fa-truck"></i> Envio a domicilio</a> 
                    </div>
                </div>
            </div>
        </div>
    </center>
    <br>
    <center><h4>NUESTROS PRODUCTOS</h4></center>
    
    <div class="row">
        @foreach ($products as $product)
            <div class="col-sm-4 mb-2">
                <div class="card card-index" style="width: 18rem">
                    <a href="{{ route('products.show', ['product' => $product->slug]) }}">
                        <img class="card-img-top" src="{{ asset('imgs/products/' . $product->thumbnail) }}" alt="Card img top">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            ${{ $product->price }} <sup>00</sup>
                        </h5>
                        <p><span></span></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-primary" wire:click="addToCart('{{ $product->slug }}')">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
            </div>       
        @endforeach
    </div>
    </div>
</div>
