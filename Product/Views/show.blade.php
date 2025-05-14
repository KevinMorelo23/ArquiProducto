@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Detalles del Producto</h2>
                        <div>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID:</strong> {{ $product->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Nombre:</strong> {{ $product->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Descripción:</strong> {{ $product->description ?? 'Sin descripción' }}
                    </div>
                    <div class="mb-3">
                        <strong>Precio:</strong> ${{ number_format($product->price, 2) }}
                    </div>
                    <div class="mb-3">
                        <strong>Stock:</strong> {{ ($product->stock) }}
                    </div>
                    <div class="mb-3">
                        <strong>Categoría:</strong> {{ $product->category->name ?? 'Sin categoría' }}
                    </div>
                    <div class="mb-3">
                        <strong>Proveedor:</strong> {{ $product->provider->name ?? 'Sin proveedor' }}
                    </div>
                    <div class="mb-3">
                        <strong>Creado:</strong> {{ $product->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="mb-3">
                        <strong>Actualizado:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection