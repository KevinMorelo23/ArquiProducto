<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="../categories/" class="nav-link " aria-current="page">Categorias</a>
            </li>
            <li class="nav-item">
                <a href="../products/" class="nav-link">Productos</a>
            </li>
            <li class="nav-item">
                <a href="../sales/" class="nav-link">Ventas</a>
            </li>
            <li class="nav-item">
                <a href="../providers/" class="nav-link">Proveedores</a>
            </li>
        </ul>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>