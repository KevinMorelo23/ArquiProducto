<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Registrar las vistas de cada dominio
$domains = ['Category', 'Payment', 'Product', 'Promociones', 'Provider', 'Report', 'Sale'];

foreach ($domains as $domain) {
    $viewPath = base_path("{$domain}/Views");
    if (is_dir($viewPath)) {
        View::addNamespace($domain, $viewPath);
    }
}

// Cargar las rutas de cada dominio
foreach ($domains as $domain) {
    $routesPath = base_path("{$domain}/routes.php");
    if (file_exists($routesPath)) {
        require_once $routesPath;
    }
}