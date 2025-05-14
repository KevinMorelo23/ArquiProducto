@extends('layouts.app')

@section('title', 'Promociones')

@section('content')
    <h1>Listado de Promociones</h1>
    <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Nueva Promoción</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descuento</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id }}</td>
                    <td>{{ $promotion->title }}</td>
                    <td>{{ $promotion->discount }}%</td>
                    <td>{{ $promotion->start_date }}</td>
                    <td>{{ $promotion->end_date }}</td>
                    <td>
                        <a href="{{ route('promotions.show', $promotion) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('promotions.edit', $promotion) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('promotions.destroy', $promotion) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar promoción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
