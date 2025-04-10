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
                <div class="col-md-4 text-center">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                        <span class="text-muted">Sin imagen</span>
                    </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h2>{{ $product->name }}</h2>
                    <p class="text-muted">Categoría: {{ $product->category->name }}</p>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Precio</h5>
                                    <p class="card-text fs-4">${{ number_format($product->price, 2) }}</p>
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