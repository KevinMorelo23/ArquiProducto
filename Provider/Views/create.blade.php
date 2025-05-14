@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Agregar Proveedor</h2>

    <form action="{{ route('providers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('providers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
