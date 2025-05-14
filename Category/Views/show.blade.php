@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Detalles de la Categoría</h2>
                        <div>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID:</strong> {{ $category->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Nombre:</strong> {{ $category->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Descripción:</strong> {{ $category->description ?? 'Sin descripción' }}
                    </div>
                    <div class="mb-3">
                        <strong>Creado:</strong> {{ $category->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="mb-3">
                        <strong>Actualizado:</strong> {{ $category->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection