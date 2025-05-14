<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Pagos')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('payments.index') }}">Pagos</a>
            <a class="navbar-brand" href="{{ route('products.index') }}">Productos</a>
            <a class="navbar-brand" href="{{ route('categories.index') }}">Categorias</a>
            <a class="navbar-brand" href="{{ route('promociones.index') }}">Promociones</a>
            <a class="navbar-brand" href="{{ route('providers.index') }}">Proveedores</a>
            <a class="navbar-brand" href="{{ route('sales.index') }}">Venta</a>
            <a class="navbar-brand" href="{{ route('reports.index') }}">Reportes</a>

        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
