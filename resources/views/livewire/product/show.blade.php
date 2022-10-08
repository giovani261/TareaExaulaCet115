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
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('imgs/products/' . $product->thumbnail) }}"  class="img-fluid img-thumbnail">
                        <p class="mt-4 text-dark" style="font-size:17px;">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @foreach($categoria as $cate)
                            <h3>{{ $cate->nombre}}</h2>
                        @endforeach
                        
                        <h3>{{ $product->name }}</h2>
                        @foreach($proveedor as $prov)
                            <span>Marca: {{ $prov->marca }}</span>
                        @endforeach
                        <h3 class="mt-3">{{ $product->price }} <sup>00</sup></h1>
                        <h6><i class="fa-solid fa-truck"></i> Vendido y entregado por: {{ config('app.name') }}</h6> 
                        <div class="text-right">
                            <button class="btn btn-outline-primary" wire:click="addToCart('{{ $product->slug }}')">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @if($relP!=null)
        <center>
            <span>PRODUCTOS RELACIONADOS</span>
        </center>
        <div class="row justify-content-center">
            <div class="col-">
                <br>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <a href="{{ route('products.show', ['product' => $relP->slug]) }}">
                            <img class="img-thumbnail" src="{{ asset('imgs/products/' . $relP->thumbnail) }}" alt="First slide" style="height:300px;">
                        </a>
                        </div>
                        @foreach($rel as $productoRel)
                            <div class="carousel-item">
                            <a href="{{ route('products.show', ['product' => $productoRel->slug]) }}">
                                <img class="img-thumbnail" src="{{ asset('imgs/products/' . $productoRel->thumbnail) }}" alt="First slide" style="height:300px;"> 
                            </a>
                            </div>
                        @endforeach
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
            </div>
        </div>
        @endif
    </div>
</div>
