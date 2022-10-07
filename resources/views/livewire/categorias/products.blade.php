<div>
    <div class="container h-100">
    @foreach ($categorias as $cat)
        <h4>
            <center>{{ $cat->nombre }}</center>
        </h4>
    @endforeach
    <span class="text-secondary"><b>{{ $productsCount }}</b> PRODUCTOS</span>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row h-100">
        <div class="col-3">
            <br>
            <span>FILTRADO POR:</span>
            <hr/>
            <span>Gama de Precios</span>
            <hr/>
            <div class="price-input">
                <div class="field">
                <span>Min</span>
                <input wire:model="precioMinimo" id="precioMin" type="number" class="input-min" value="2500">
                </div>
                <div class="separator">-</div>
                <div class="field">
                <span>Max</span>
                <input wire:model="precioMaximo" id="precioMax" type="number" class="input-max" value="7500">
                </div>
            </div>
            <div class="slider">
                <div class="progress"></div>
            </div>
            <div class="range-input">
                <input type="range" class="range-min" min="0" max="10000" value="0" step="10">
                <input type="range" class="range-max" min="0" max="10000" value="10000" step="10">
            </div>
        </div>
        @foreach ($productos as $product)
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
<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");
    let priceGap = 10; //original 1000

    priceInput.forEach(input =>{
        input.addEventListener("input", e =>{
            let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);
            
            if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
                if(e.target.className === "input-min"){
                    rangeInput[0].value = minPrice;
                    range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                }else{
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                }
            }
        });
    });

    rangeInput.forEach(input =>{
        input.addEventListener("input", e =>{
            let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

            if((maxVal - minVal) < priceGap){
                if(e.target.className === "range-min"){
                    rangeInput[0].value = maxVal - priceGap
                }else{
                    rangeInput[1].value = minVal + priceGap;
                }
            }else{
                priceInput[0].value = minVal;
                document.getElementById("precioMin").dispatchEvent(new Event('input'));
                priceInput[1].value = maxVal;
                document.getElementById("precioMax").dispatchEvent(new Event('input'));
                range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            }
        });
    });
</script>
