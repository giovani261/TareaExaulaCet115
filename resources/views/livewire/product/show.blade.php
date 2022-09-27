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
        <div class="row mt-4">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}"  class="img-fluid">
                        <p class="mt-4 text-dark" style="font-size:17px;">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
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
                        <div class="text-right">
                            <button class="btn btn-outline-primary" wire:click="addToCart('{{ $product->slug }}')">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
