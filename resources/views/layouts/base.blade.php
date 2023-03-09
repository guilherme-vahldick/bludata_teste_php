<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Página de Teste em PHP da Bludata.">
        <meta name="theme-color" content="#FFFFFF" />

        <title>BluData - Teste em PHP</title>

        <!-- Favicon !-->
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Google Fonts !-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome 6 !-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

        <!-- Sweet Alert 2 !-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- CSS do Site !-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="site-wrapper">
            <header class="site-header">
                <div class="container">
                    <nav class="navbar justify-content-between align-items-center navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="site-header__logo">
                            <a href="{{ url('') }}" title="BluData">
                                <img class="site-header__logo" src="{{ asset('img/logo-bludata.png') }}" alt="Logo BluData" />
                            </a>
                        </div>
                        <div class="site-header__menu collapse navbar-collapse mt-2 mt-md-0" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item mx-1">
                                    <a class="site-header__menu__link nav-link
                                        {{ (strpos(Route::currentRouteName(), 'empresa') !== false) ? 'site-header__menu__link--active' : '' }}"
                                            href="{{ route('empresa.index') }}">Empresas</a>
                                </li>
                                <li class="nav-item mx-1">
                                    <a class="site-header__menu__link nav-link
                                        {{ (strpos(Route::currentRouteName(), 'fornecedor') !== false) ? 'site-header__menu__link--active' : '' }}"
                                            href="{{ route('fornecedor.index') }}">Fornecedores</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="site-content">
                <div class="container mt-4">
                    @yield('content')
                </div>
            </div>
            <div class="container">
                <footer class="site-footer">
                    Avaliação de Conhecimentos / <strong>Programador PHP - Guilherme Vahldick</strong>
                </footer>
            </div>
        </div>

        <!-- Scripts do Site !-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>

        @yield('scripts')
        <script>
            $(function(){
                //SweetAlert
                @if (Session::has('flash_message'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: '{{ Session::get('flash_message') }}'
                    })
                @endif
                @if (Session::has('flash_message_error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ Session::get('flash_message_error') }}'
                    })
                @endif
                @if ($errors->any())
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: '{!! implode(' <br> ', $errors->all()) !!}'
                    })
                @endif
            })
        </script>
    </body>
</html>
