@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Nueva Venta</h1>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Ventas
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form id="saleForm" action="{{ route('sales.store') }}" method="POST">
        @csrf

        <!-- Contenedor para los campos ocultos de productos -->
        <div id="products-container"></div>

        <div class="mb-4 card">
            <div class="card-header ">
                <h5 class="mb-0">Productos</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="products-table">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="no-products">
                                <td colspan="5" class="py-4 text-center">Agregue productos a la venta</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold">$<span id="total">0.00</span></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <button type="button" class="mt-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#productsModal">
                    <i class="fas fa-plus-circle"></i> Agregar Productos
                </button>

                <input type="hidden" name="total" id="total-input" value="0">
            </div>
        </div>
        <div class="mb-4 card">
            <div class="card-header ">
                <h5 class="mb-0">Datos de envio</h5>
            </div>

            <div class="container mt-4">


            <div class="mb-3">
    <label for="shipping_name">Nombre del destinatario</label>
    <input type="text" name="shipping_name" id="shipping_name" class="form-control">
</div>
<div class="mb-3">
    <label for="shipping_address">Dirección de envío</label>
    <input type="text" name="shipping_address" id="shipping_address" class="form-control">
</div>
<div class="mb-3">
    <label for="shipping_city">Ciudad</label>
    <input type="text" name="shipping_city" id="shipping_city" class="form-control">
</div>
<div class="mb-3">
    <label for="shipping_phone">Teléfono</label>
    <input type="text" name="shipping_phone" id="shipping_phone" class="form-control">
</div>

            </div>
        </div>


        <div class="mb-4 card">
            <div class="card-header">
                <h5 class="mb-0">Método de Pago</h5>
            </div>
            <div class="card-body">
                <div class="mb-4 form-group">
                    <label for="payment_method" class="form-label">Seleccione el método de pago:</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="">Seleccionar...</option>
                        <option value="cash">Efectivo</option>
                        <option value="transfer">Transferencia</option>
                        <option value="credit_card">Tarjeta de Crédito</option>
                        <option value="debit_card">Tarjeta de Débito</option>
                    </select>
                </div>
                <div id="payment-details"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
                <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
                <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
                <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
                <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
                <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
                <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
                <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
                <path d="M9 12l2 2l4 -4" />
            </svg> Continuar con el pago
        </button>
    </form>
</div>

<!-- Modal para seleccionar productos -->
<div class="modal fade" id="productsModal" tabindex="-1" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productsModalLabel">Seleccionar Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Cantidad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <input type="number" class="form-control quantity-input" min="1" max="{{ $product->stock }}" value="1">
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary add-product" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                                    Agregar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        const paymentDetails = document.getElementById('payment-details');
        paymentDetails.innerHTML = ''; // Limpiar contenido anterior

        switch (this.value) {
            case 'cash':
                paymentDetails.innerHTML = `
                    <div class="mb-3 form-group">
                        <label for="amount_tendered">Monto Recibido:</label>
                        <input type="number" class="form-control" id="amount_tendered" name="amount_tendered" step="0.01">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="change">Cambio:</label>
                        <input type="text" class="form-control" id="change" name="change" readonly>
                    </div>
                `;


                // Añadir evento para calcular el cambio
                setTimeout(() => {
                    const amountInput = document.getElementById('amount_tendered');
                    const changeField = document.getElementById('change');
                    const totalAmount = parseFloat(document.getElementById('total-input').value);

                    amountInput.addEventListener('input', function() {
                        const amountTendered = parseFloat(this.value) || 0;
                        const change = amountTendered - totalAmount;
                        changeField.value = change >= 0 ? +change.toFixed(2) : '';
                    });
                }, 100);
                break;

            case 'transfer':
                paymentDetails.innerHTML = `
                    
                    <div class="mb-3 form-group">
                        <label for="reference_number">Número de Referencia:</label>
                        <input type="text" class="form-control" id="reference_number" name="reference_number">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="bank_name">Seleccionar Banco:</label>
                        <select class="form-select" id="bank_name" name="bank_name">
                            <option value="">Seleccione un banco...</option>
                            <option value="bancolombia">Bancolombia</option>
                            <option value="nequi">Nequi</option>
                            <option value="bogota">Banco de Bogotá</option>
                            <option value="bbva">BBVA</option>
                            <option value="davivienda">Davivienda</option>
                            <option value="nubank">NuBank</option>
                            <option value="lulobank">LuloBank</option>
                        </select>
                    </div>
                `;
                break;

            case 'credit_card':
                paymentDetails.innerHTML = `
                    <div class="mb-3 form-group">
                        <label for="card_number">Número de Tarjeta:</label>
                        <input type="text" class="form-control" id="card_number" name="card_number">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="cardholder_name">Nombre del Titular:</label>
                        <input type="text" class="form-control" id="cardholder_name" name="cardholder_name">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="card_expiry">Fecha de Expiración (MM/YY):</label>
                        <input type="text" class="form-control" id="card_expiry" name="card_expiry" placeholder="MM/YY">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="installments">Número de Cuotas:</label>
                        <select class="form-select" id="installments" name="installments">
                            <option value="1">1 cuota</option>
                            <option value="2">2 cuotas</option>
                            <option value="3">3 cuotas</option>
                            <option value="6">6 cuotas</option>
                            <option value="12">12 cuotas</option>
                        </select>
                    </div>
                `;
                break;
            case 'debit_card':
                paymentDetails.innerHTML = `
                    <div class="mb-3 form-group">
                        <label for="card_number">Número de Tarjeta:</label>
                        <input type="text" class="form-control" id="card_number" name="card_number">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="cardholder_name">Nombre del Titular:</label>
                        <input type="text" class="form-control" id="cardholder_name" name="cardholder_name">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="card_expiry">Fecha de Expiración (MM/YY):</label>
                        <input type="text" class="form-control" id="card_expiry" name="card_expiry" placeholder="MM/YY">
                    </div>
                `;
                break;
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const productTable = document.querySelector("#products-table tbody");
        const totalDisplay = document.querySelector("#total");
        const totalInput = document.querySelector("#total-input");
        const productsContainer = document.querySelector("#products-container");
        let productCount = 0;

        function updateTotal() {
            let total = 0;
            document.querySelectorAll(".subtotal").forEach(subtotal => {
                total += parseFloat(subtotal.textContent);
            });
            totalDisplay.textContent = total.toFixed(2);
            totalInput.value = total.toFixed(2);

            // Actualizar campo de cambio si está visible
            const amountInput = document.getElementById('amount_tendered');
            const changeField = document.getElementById('change');
            if (amountInput && changeField) {
                const amountTendered = parseFloat(amountInput.value) || 0;
                const change = amountTendered - total;
                changeField.value = change >= 0 ? '$' + change.toFixed(2) : '';
            }
        }

        function removeNoProductsRow() {
            const noProductsRow = document.getElementById('no-products');
            if (noProductsRow) {
                noProductsRow.remove();
            }
        }

        function addNoProductsRowIfNeeded() {
            if (productTable.querySelectorAll('tr:not(#no-products)').length === 0) {
                const noProductsRow = document.createElement('tr');
                noProductsRow.id = 'no-products';
                noProductsRow.innerHTML = '<td colspan="5" class="py-4 text-center">Agregue productos a la venta</td>';
                productTable.appendChild(noProductsRow);
            }
        }

        document.querySelectorAll(".add-product").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);
                const stock = parseInt(this.dataset.stock);
                const quantityInput = this.closest("tr").querySelector(".quantity-input");
                const quantity = parseInt(quantityInput.value);

                if (quantity > stock) {
                    alert("Stock insuficiente.");
                    return;
                }

                // Remover la fila "no hay productos" si existe
                removeNoProductsRow();

                // Crear ID único para este producto en esta venta
                const productRowId = `product-${productCount}`;
                productCount++;

                // Agregar fila visual a la tabla
                let row = document.createElement("tr");
                row.id = productRowId;
                row.innerHTML = `
                    <td>${name}</td>
                    <td>$${price.toFixed(2)}</td>
                    <td>${quantity}</td>
                    <td class="subtotal">${(price * quantity).toFixed(2)}</td>
                    <td>
                        <button type="button" class="p-0 bg-transparent border-0 text-danger remove-product" data-row-id="${productRowId}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eraser">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" />
                                <path d="M18 13.3l-6.3 -6.3" />
                            </svg>
                        </button>
                    </td>
                `;
                productTable.appendChild(row);

                // Agregar campos ocultos para enviar al servidor
                productsContainer.innerHTML += `
                    <input type="hidden" name="products[${productRowId}][id]" value="${id}">
                    <input type="hidden" name="products[${productRowId}][quantity]" value="${quantity}">
                    <input type="hidden" name="products[${productRowId}][price]" value="${price}">
                `;

                // Actualizar el total
                updateTotal();

                // Resetear el valor de cantidad en el modal
                quantityInput.value = 1;

                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('productsModal'));
                modal.hide();
            });
        });

        // Delegación de eventos para manejar la eliminación de productos
        productTable.addEventListener('click', function(e) {
            if (e.target.closest('.remove-product')) {
                const button = e.target.closest('.remove-product');
                const rowId = button.dataset.rowId;

                // Eliminar la fila de la tabla
                document.getElementById(rowId).remove();

                // Eliminar los campos ocultos correspondientes
                document.querySelectorAll(`input[name^="products[${rowId}]"]`).forEach(input => {
                    input.remove();
                });

                // Actualizar el total
                updateTotal();

                // Verificar si necesitamos mostrar la fila "no hay productos"
                addNoProductsRowIfNeeded();
            }
        });

        // Validación del formulario
        document.getElementById('saleForm').addEventListener('submit', function(e) {
            // Verificar que hay productos agregados
            if (productTable.querySelectorAll('tr:not(#no-products)').length === 0) {
                e.preventDefault();
                alert('Debe agregar al menos un producto a la venta.');
                return false;
            }

            // Verificar método de pago
            const paymentMethod = document.getElementById('payment_method').value;
            if (!paymentMethod) {
                e.preventDefault();
                alert('Debe seleccionar un método de pago.');
                return false;
            }

            // Validaciones específicas por método de pago
            if (paymentMethod === 'cash') {
                const amountTendered = parseFloat(document.getElementById('amount_tendered').value) || 0;
                const total = parseFloat(document.getElementById('total-input').value);
                if (amountTendered < total) {
                    e.preventDefault();
                    alert('El monto recibido debe ser mayor o igual al total de la venta.');
                    return false;
                }
            }

            return true;
        });
    });
</script>
@endsection