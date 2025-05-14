@extends('layouts.app')

@section('title', 'Detalle de Promoción')

@section('content')
    <h1>Promoción: {{ $promotion->title }}</h1>

    <p><strong>Descuento:</strong> {{ $promotion->discount }}%</p>
    <p><strong>Inicio:</strong> {{ $promotion->start_date }}</p>
    <p><strong>Fin:</strong> {{ $promotion->end_date }}</p>

    <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Volver</a>
@endsection
