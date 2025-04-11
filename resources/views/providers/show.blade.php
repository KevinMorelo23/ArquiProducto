@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Productos del Proveedor: {{ $provider->name }}</h1>
        <a href="{{ route('providers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Proveedores
        </a>
    </div>

    @if($provider->products->count())
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($provider->products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text mb-1"><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text mb-1"><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p class="card-text mb-1"><strong>Categoría:</strong> {{ $product->category->name ?? 'Sin categoría' }}</p>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info">
        Este proveedor aún no tiene productos registrados.
    </div>
    @endif
</div>
@endsection
