@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ventas</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">
            <i class="fas fa-shopping-cart"></i> Nueva Venta
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Método de Pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>${{ number_format($sale->total, 2) }}</td>
                            <td>
                                @switch($sale->payment_method)
                                @case('cash')
                                <span class="badge rounded-pill text-bg-success">Efectivo</span>
                                @break
                                @case('transfer')
                                <span class="badge rounded-pill text-bg-primary">Transferencia</span>
                                @break
                                @case('credit_card')
                                <span class="badge rounded-pill text-bg-secondary">Tarjeta de Crédito</span>
                                @break
                                @case('debit_card')
                                <span class="badge rounded-pill text-bg-dark">Tarjeta de Débito</span>
                                @break
                                @default
                                <span class="badge bg-secondary">Otro</span>
                                @endswitch
                            </td>
                            <td>
                                @switch($sale->status)
                                @case('pending')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                                @break
                                @case('completed')
                                <span class="btn btn-outline-success">Completada</span>
                                @break
                                @case('cancelled')
                                <span class="badge bg-danger">Cancelada</span>
                                @break
                                @default
                                <span class="badge bg-secondary">Desconocido</span>
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-outline-secondary">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No hay ventas registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="../products" class="btn btn-outline-secondary mt-4">Ver Productos</a>
</div>
@endsection