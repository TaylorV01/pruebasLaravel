<!DOCTYPE html>
<html>
<head>
    <title>Mi Sistema de Facturación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { padding-top: 20px; }
        .navbar { margin-bottom: 20px; }
        .nav-item .active {
            font-weight: bold;
            color: #0d6efd !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <i class="bi bi-receipt"></i> Sistema de Facturación
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos*') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                                <i class="bi bi-box-seam"></i> Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                                <i class="bi bi-people"></i> Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('facturas*') ? 'active' : '' }}" href="{{ route('facturas.index') }}">
                                <i class="bi bi-file-earmark-text"></i> Facturas
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="card">
            <div class="card-body">
                @yield('content')
            </div>
        </div>

        <footer class="mt-4 text-center text-muted">
            <hr>
            <p>&copy; {{ date('Y') }} Sistema de Facturación</p>
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
