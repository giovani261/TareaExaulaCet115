<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos3.css') }}" rel="stylesheet" />
    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbgcolor shadow-sm">
            <div class="container">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a id="inicio" class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </li>
                </ul>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="navbar-brand" href="tel:503-2298-3777"><i class="fa-solid fa-phone"></i> 2298-3777</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach(config('Categorias') as $item)
                                    <a class="dropdown-item" href="{{ route('categoria.show', ['categoria_id' => $item->id]) }}">{{ $item->nombre }}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="navbar-brand" href="{{ route('preguntas_frecuentes') }}"><i class="fa-solid fa-circle-question"></i> Preguntas Frecuentes</a>
                    </li>
                        <!-- Authentication Links -->

                        <li class="nav-item">
                            <livewire:cart />
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-arrow-right-to-bracket"></i> {{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('ordenes.index') }}">Ver mis ordenes</a>
                                    @role('administrador')
                                        <a class="dropdown-item" href="{{ url('/create') }}">
                                            Crear Producto
                                        </a>
                                        <a class="dropdown-item" href="{{ route('ordenes.indexAdmin') }}">
                                            Ver Pedidos de clientes
                                        </a>
                                    @endrole
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    @stack('scripts')
    <script src="{{ asset('js/scripts2.js') }}"></script>

    <footer id="footer" class="midnight-blue">
            <style>
                .col h4{
                    color: white;
                }
                p{
                    color: white;
                    font-size: 85%;
                }               
                .fblink{
                    color: white;
                    font-size: 85%;                          
                }
                .twitterlink{
                    color: white;
                    font-size: 85%;                                             
                }
            </style>
            <br>
            <center>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div>
                                <h5 style="color: white;">Contactos</h5>        
                                <a href="https://twitter.com/" class="twitterlink" target="_blank">
                                    <i class="fa-brands fa-twitter twittericon"></i>
                                    <br>
                                    @asdfgg
                                </a>
                            </div>
                            <br>
                            <span class="fbspan">   
                                    <i class="fa-brands fa-facebook fbicon"></i>
                                    <br>
                                    <a href="https://www.facebook.com/" class="fblink" target="_blank" style="font-size: 12px;">/asdfdf</a>
                                    <br>
                                    <a href="https://www.facebook.com/" class="fblink" target="_blank" style="font-size: 12px;">/asfdgfg</a>
                            </span>
                            <br>
                        </div>
                        <div class="col">
                            <h5 style="color: white;">Empresa</h5>
                            <p style="font-size: 12px;"><i class="fa-solid fa-map-location-dot"></i> 23 Av. Nte. # 1318. Col. Medica. Contiguo Hospital PNC</p>
                            <p style="font-size: 12px;"><i class="fa-solid fa-phone"></i> TEL.: 2519-3909</p>
                            <p style="font-size: 12px;"><i class="fa-solid fa-window-maximize"></i> https://</p>
                            <p style="font-size: 12px;"><i class="fa-solid fa-envelope"></i> correo</p>
                        </div>
                        <div class="col">
                            <h5 style="color: white;">Marcas</h5>
                            <a href="http://adidas.com/" target="_blank"><img src="{{ asset('imgs/m1.png') }}" alt="Marca 1" class="img-thumbnail asc1" style="height: 80px; width: 80px;"></a>
                            <a href="https://nike.com/" target="_blank"><img src="{{ asset('imgs/m2.jpg') }}" alt="Marca 2" class="img-thumbnail asc2" style="height: 80px; width: 80px;"></a>
                            <a href="https://puma.com" target="_blank"><img src="{{ asset('imgs/m3.png') }}" alt="Marca 3" class="img-thumbnail asc3" style="height: 80px; width: 80px;"></a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <center>
                                <img src="{{ asset('imgs/pagos-seguros-autorizado.jpg') }}" alt="Pagos Seguros" class="img-thumbnail" style="height: 150px; width: 500px;">
                            </center>
                        </div>
                    </div>
                </div>
            </center>
       </footer>
       <a href="#inicio" id="asubir"><img src="{{ asset('imgs/subir.png') }}" alt="Subir" class="btnSubir" id="btnSubir"></a>
       <script>
  window.watsonAssistantChatOptions = {
    integrationID: "b1191e6e-3184-40d0-a383-9676cd777b82", // The ID of this integration.
    region: "us-south", // The region your integration is hosted in.
    serviceInstanceID: "f430015f-fd83-4b74-82dd-c41bf1a35e1b", // The ID of your service instance.
    onLoad: function(instance) { instance.render(); }
  };
  setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
    document.head.appendChild(t);
  });
</script>
</body>
</html>
