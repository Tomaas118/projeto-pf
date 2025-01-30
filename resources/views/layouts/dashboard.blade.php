<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .navbar {
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.1);
            z-index: 2;
            padding-left: 20px;
        }
        .navbar-nav .nav-item {
            margin-left: 20px;
        }
        .main-content {
            padding: 20px;
        }
    </style>
    @yield('styles')

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="{{ auth()->user()->is_medic ? route('MedicoDashboard') : route('PacienteDashboard') }}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                @if(auth()->user()->is_medic)
                    <li class="nav-item">
                        <a class="nav-link" href="Baixas-temporarias">Ver Baixas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gerir Centro Hospitalar</a>
                    </li>
                @endif
                    @yield('navbar-content')
                </ul>

                <ul class="navbar-nav ml-auto">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item" href="#">Configurações</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        @yield('content')
    </div>
    @yield('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
