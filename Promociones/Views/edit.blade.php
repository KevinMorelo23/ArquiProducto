@extends('layouts.app')

@section('title', 'Editar Promoción')

@section('content')
    <h1>Editar Promoción</h1>

    <form action="{{ route('promotions.update', $promotion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ $promotion->title }}" required>
        </div>

        <div class="mb-3">
            <label for="discount" class="form-label">Descuento (%)</label>
            <input type="number" name="discount" class="form-control" value="{{ $promotion->discount }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" class="form-control" value="{{ $promotion->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Fecha de Fin</label>
            <input type="date" name="end_date" class="form-control" value="{{ $promotion->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
