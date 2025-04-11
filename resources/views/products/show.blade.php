@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalles del Producto</h1>
        <div>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                
                <div class="">
                    <h2>{{ $product->name }}</h2>
                    <p class="text-muted">Categoría: {{ $product->category->name }}</p>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Precio</h5>
                                    <p class="card-text fs-4">${{ number_format($product->price, ) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Stock</h5>
                                    <p class="card-text fs-4 
                                        @if($product->stock <= 5) text-danger 
                                        @elseif($product->stock <= 15) text-warning 
                                        @else text-success @endif">
                                        {{ $product->stock }} unidades
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            Proveedor
                        </div>
                        <div class="card-body">
                            @if($product->provider)
                            {{ $product->provider->name }}
                            @else
                            <p class="text-muted">Sin Proveedor</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Descripción
                        </div>
                        <div class="card-body">
                            @if($product->description)
                            {{ $product->description }}
                            @else
                            <p class="text-muted">Sin descripción</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            Creado: {{ $product->created_at->format('d/m/Y H:i') }} |
                            Última actualización: {{ $product->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection