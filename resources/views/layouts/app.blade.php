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


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en'rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/mdDateTimePicker.css') }}">
    @yield('css_extra')


</head>
<body style="background-color:lightblue">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm">
            <div class="container">
                @if (Auth::user())
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Hospital Nuestra Familia
                </a>
                @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    Hospital Nuestra Familia
                </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                        @endguest
                        @if(Auth::user())
                        @if (Auth::user()->role =='administrador')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('especialidades.index') }}">{{ __('Gestión Especialidades') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personaMostrarMedicos') }}">{{ __('Gestión Médicos') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cita.index') }}">{{ __('Gestión citas') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cliente.create') }}">{{ __('Registrar Cliente') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('paciente.create') }}">{{ __('Registrar Paciente') }}</a>
                        </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    {{ Auth::user()->role }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                        @if (Auth::user()->role =='medico')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('HistorialMedico.index') }}">{{ __('Historial Médico') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cita.index') }}">{{ __('Revisar Agenda') }}</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    {{ Auth::user()->role }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        @endif
                        @if (Auth::user()->role =='cliente')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pacienteCliente.create', $id =Auth::user()->idPersona)}}">{{ __('Registrar Paciente')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('HistorialMedico.index') }}">{{ __('Historial Médico') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cita.index') }}">{{ __('Gestión citas') }}</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    {{ Auth::user()->role }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('js/draggabilly.pkgd.min.js')}}"></script>
<script src="{{asset('js/mdDateTimePicker.js')}}"></script>
@yield('js_extras')
</html>
