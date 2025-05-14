@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Detalles de la Venta #{{ $sale->id }}</h1>
        <div>
       
            <button id="btnImprimir" class="btn btn-primary me-2">
                <i class="fas fa-print"></i> Imprimir
            </button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Ventas
            </a>
        </div>
    </div>

    <div id="contenidoImprimible">
        <div class="mb-4 card ">
            <div class="card-header">
                <h5 class="mb-0">Información de la Venta</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Fecha:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Total:</strong> ${{ number_format($sale->total) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Método de Pago:</strong> {{ ucfirst($sale->payment_method) }}</p>
                        @if($sale->payment)
                        @switch($sale->payment_method)
                        @case('cash')
                        <p><strong>Monto Recibido:</strong> ${{ number_format($sale->payment->amount_tendered) }}</p>
                        <p><strong>Cambio:</strong> ${{ number_format($sale->payment->change) }}</p>
                        @break
                        @case('transfer')
                        <p><strong>Banco:</strong> {{ $sale->payment->bank_name }}</p>
                        <p><strong>Número de Referencia:</strong> {{ $sale->payment->reference_number }}</p>
                        @break
                        @case('credit_card')
                        @case('debit_card')
                        <p><strong>Número de Tarjeta:</strong> {{ substr($sale->payment->card_number, 0, 0) }}**** **** **** {{ substr($sale->payment->card_number, -4) }}</p>
                        <p><strong>Numero de Cuotas:</strong> {{ $sale->payment->installments }}</p>
                        <p><strong>Titular:</strong> {{ $sale->payment->cardholder_name }}</p>
                        <p><strong>Fecha de Expiración:</strong> {{ $sale->payment->card_expiry }}</p>
                        @break
                        @endswitch
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 card">
            <div class="card-header">
                <h5 class="mb-0">Información de Envio</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>A nombre de:</strong> {{ $sale->shipping_name }}</p>
                        <p><strong>Número:</strong> {{ $sale->shipping_phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Dirección:</strong> {{ $sale->shipping_address }}</p>
                        <p><strong>Ciudad:</strong> {{ $sale->shipping_city }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Productos</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->products as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>${{ number_format($item->pivot->price, 2) }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>${{ number_format($item->pivot->price * $item->pivot->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold">${{ number_format($sale->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnImprimir').addEventListener('click', function() {
        const contenido = document.getElementById('contenidoImprimible').innerHTML;
        const ventanaImpresion = window.open('', '', 'height=600,width=800');
        
        ventanaImpresion.document.write(`
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Factura de Venta #{{ $sale->id }}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body {
                        padding: 20px;
                        font-family: Arial, sans-serif;
                    }
                    .container {
                        max-width: 800px;
                        margin: 0 auto;
                    }
                    @media print {
                        .no-imprimir {
                            display: none !important;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Factura de Venta #{{ $sale->id }}</h2>
                        <button onclick="window.print()" class="btn btn-sm btn-primary no-imprimir">Imprimir</button>
                    </div>
                    ${contenido}
                    <div class="text-center mt-4">
                        <p>¡Gracias por su compra!</p>
                    </div>
                </div>
                <script>
                    // Imprimir automáticamente después de cargar la página
                    // window.onload = function() { window.print(); }
                <\/script>
            </body>
            </html>
        `);
        
        ventanaImpresion.document.close();
        ventanaImpresion.focus();
    });
});
</script>
@endsection