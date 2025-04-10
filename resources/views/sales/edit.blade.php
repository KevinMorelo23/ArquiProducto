@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Editar Venta</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Información del Pedido -->
                <div class="form-group mb-3">
                    <label for="order_id" class="form-label">ID del Pedido:</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $sale->id }}" readonly>
                </div>

                <!-- Cliente -->
                <div class="form-group mb-3">
                    <label for="customer_name" class="form-label">Cliente:</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $sale->customer_name }}">
                </div>

                <!-- Productos -->
                <div class="form-group mb-3">
                    <label class="form-label">Productos:</label>
                    <ul class="list-group" id="product-list">
                        @foreach ($sale->products as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $product->name }} <span class="badge bg-primary">{{ $product->quantity }} x ${{ number_format($product->price, 2) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Total -->
                <div class="form-group mb-3">
                    <label for="total" class="form-label">Total a Pagar:</label>
                    <input type="text" class="form-control" id="total" name="total" value="${{ number_format($sale->total, 2) }}" readonly>
                </div>

                <!-- Método de Pago -->
                <div class="form-group mb-3">
                    <label for="payment_method" class="form-label">Método de Pago:</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="">Seleccionar...</option>
                        <option value="cash" {{ $sale->payment_method == 'cash' ? 'selected' : '' }}>Efectivo</option>
                        <option value="transfer" {{ $sale->payment_method == 'transfer' ? 'selected' : '' }}>Transferencia</option>
                        <option value="credit_card" {{ $sale->payment_method == 'credit_card' ? 'selected' : '' }}>Tarjeta de Crédito</option>
                        <option value="debit_card" {{ $sale->payment_method == 'debit_card' ? 'selected' : '' }}>Tarjeta de Débito</option>
                    </select>
                </div>

                <!-- Detalles del Método de Pago -->
                <div id="payment-details">
                    @if ($sale->payment_method == 'credit_card')
                    <div class="form-group mb-3">
                        <label for="installments">Número de Cuotas:</label>
                        <input type="number" class="form-control" id="installments" name="installments" value="{{ $sale->installments }}">
                    </div>
                    @endif
                </div>

                <!-- Botón para Guardar -->
                <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const paymentMethod = document.getElementById("payment_method");
        const paymentDetails = document.getElementById("payment-details");

        function updatePaymentDetails(method) {
            paymentDetails.innerHTML = "";

            if (method === "credit_card") {
                paymentDetails.innerHTML = `
                    <div class="form-group mb-3">
                        <label for="installments">Número de Cuotas:</label>
                        <input type="number" class="form-control" id="installments" name="installments" min="1" value="{{ $sale->installments ?? 1 }}">
                    </div>
                `;
            }
        }

        paymentMethod.addEventListener("change", function() {
            updatePaymentDetails(this.value);
        });

        updatePaymentDetails(paymentMethod.value);
    });
</script>

@endsection