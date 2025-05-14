@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Proveedor</h2>

    <form action="{{ route('providers.update', $provider->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $provider->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ $provider->email }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ $provider->phone }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <textarea name="address" class="form-control">{{ $provider->address }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('providers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
