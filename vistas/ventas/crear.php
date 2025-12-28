<div class="container mt-5">
    <div class="card">
        <div class="card-header">Venta de Productos</div>
        <div class="card-body">
            <form id="formInsertarProductoVenta" action="?controlador=ventas&accion=crear" method="post">
                <div class="mb-3">
                    <label for="id_tienda_producto" class="form-label">Producto en Tienda</label>
                    <select class="form-select" id="id_tienda_producto" name="id_tienda_producto">
                        <option value="">Seleccione un producto en tienda</option>
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?= $producto['id_tienda_producto'] ?>" data-precio="<?= $producto['precio_unitario'] ?>">
                                <?= $producto['producto'] ?> - <?= $producto['tienda'] ?> (<?= $producto['precio_unitario'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <button type="button" id="add-product-btn" class="btn btn-primary">Agregar Producto</button>
                </div>

                <table class="table table-striped" id="productos-table">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Costo Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productos-container">
                        <!-- Los productos se agregarán aquí dinámicamente -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total Venta:</strong></td>
                            <td id="total-costo">$0.00</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <input type="hidden" id="costo_total_venta" name="costo_total_venta" value="0.00">

                <div class="mb-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Registrar Venta</button>
                    <a href="?controlador=ventas&accion=inicio" class="btn btn-danger">Cancelar</a>
                </div>

            </form>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fechaInput = document.getElementById('fecha');

        var today = new Date(); // Obtener la fecha actual
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
        var year = today.getFullYear();

        var fechaActual = year + '-' + month + '-' + day;
        fechaInput.value = fechaActual; // Establecer el valor del input con la fecha actual

        // Monitorear cambios en la fecha
        document.getElementById('fecha').addEventListener('change', function() {
            console.log("Nueva fecha seleccionada: " + this.value); // Para depuración
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let productIndex = 0;

        // Función para actualizar el total de la venta
        function updateCosts() {
            let totalVenta = 0;
            const rows = document.querySelectorAll('#productos-container tr');

            rows.forEach(row => {
                const cantidadInput = row.querySelector('.cantidad');
                const costoTotalInput = row.querySelector('.costo_total');
                const costoInput = row.querySelector('.costo');

                const cantidad = parseFloat(cantidadInput.value) || 0;
                const precioUnitario = parseFloat(costoInput.value) || 0;
                const costoTotal = cantidad * precioUnitario;

                costoTotalInput.textContent = `$${costoTotal.toFixed(2)}`;
                totalVenta += costoTotal;
            });

            document.getElementById('total-costo').textContent = `$${totalVenta.toFixed(2)}`;
            document.getElementById('costo_total_venta').value = totalVenta.toFixed(2);
        }

        // Manejar el evento de agregar producto
        document.getElementById('add-product-btn').addEventListener('click', function() {
            const idProducto = document.getElementById('id_tienda_producto').value;
            const cantidad = document.getElementById('cantidad').value;
            const productoSeleccionado = document.querySelector(`#id_tienda_producto option[value="${idProducto}"]`);
            const precioUnitario = productoSeleccionado ? parseFloat(productoSeleccionado.getAttribute('data-precio')) : 0;
            const nombreProducto = productoSeleccionado ? productoSeleccionado.textContent : 'Desconocido';

            if (idProducto && cantidad && cantidad > 0) {
                const tableBody = document.getElementById('productos-container');

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="number" class="form-control cantidad" name="productos[${productIndex}][cantidad]" value="${cantidad}" readonly></td>
                    <td>${nombreProducto}</td>
                    <td><input type="number" class="form-control costo" name="productos[${productIndex}][costo]" value="${precioUnitario}" readonly></td>
                    <td class="costo_total">$${(cantidad * precioUnitario).toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm btn-remove">Eliminar</button></td>
                    <input type="hidden" name="productos[${productIndex}][id_tienda_producto]" value="${idProducto}">
                    <input type="hidden" name="productos[${productIndex}][costo_total]" value="${(cantidad * precioUnitario).toFixed(2)}">
                `;

                tableBody.appendChild(row);
                productIndex++; // Incrementar el índice para el siguiente producto

                updateCosts();

                // Limpiar los campos de selección de producto y cantidad después de agregar
                document.getElementById('id_tienda_producto').value = "";
                document.getElementById('cantidad').value = "";
            } else {
                alert('Seleccione un producto y una cantidad válida.');
            }
        });

        // Manejar el evento de eliminar producto
        document.getElementById('productos-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-remove')) {
                const row = event.target.closest('tr');
                row.remove();
                updateCosts();
            }
        });
    });
</script>
