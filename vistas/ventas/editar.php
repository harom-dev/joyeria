<div class="card">
    <div class="card-header">Editar Producto Vendido</div>
    <div class="card-body">
        <?php if (isset($productoSeleccionado) && isset($productos)): ?>
            <form id="formEditarProducto" action="?controlador=ventas&accion=editar" method="post" onsubmit="return validarFormulario();">
                <input type="hidden" id="editar_id" name="id" value="<?php echo htmlspecialchars($productoSeleccionado['id'], ENT_QUOTES, 'UTF-8'); ?>">

                <div class="mb-3">
                    <label for="editar_id_tienda_producto" class="form-label">Producto en Tienda</label>
                    <select class="form-select" id="editar_id_tienda_producto" name="id_tienda_producto" required>
                        <option value="">Seleccione un producto en tienda</option>
                        <?php
                        foreach ($productos as $producto) {
                            $selected = ($producto['id_tienda_producto'] == $productoSeleccionado['id_tienda_producto']) ? "selected" : "";
                            echo "<option value='{$producto['id_tienda_producto']}' {$selected}>{$producto['producto']} - {$producto['tienda']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="editar_fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="editar_fecha" name="fecha" value="<?php echo htmlspecialchars($productoSeleccionado['fecha'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="editar_cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="editar_cantidad" name="cantidad" value="<?php echo htmlspecialchars($productoSeleccionado['cantidad'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="editar_costo" class="form-label">Costo</label>
                    <input type="number" step="0.01" class="form-control" id="editar_costo" name="costo" value="<?php echo htmlspecialchars($productoSeleccionado['costo'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="editar_costo_total" class="form-label">Costo Total</label>
                    <input type="number" step="0.01" class="form-control" id="editar_costo_total" name="costo_total" value="<?php echo htmlspecialchars($productoSeleccionado['costo_total'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <input name="" id="" class="btn btn-primary" type="submit" value="Guardar" />
                    <a href="?controlador=ventas&accion=inicio" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
            </form>
        <?php else: ?>
            <p>Error: No se encontró el producto seleccionado o la lista de productos no está disponible.</p>
        <?php endif; ?>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Asignar valores al formulario al cargar la página si ya están disponibles
        var cardEditarProducto = document.getElementById('formEditarProducto');

        // Si hay valores en los atributos data-* (si usas un botón para prellenar el formulario), asignarlos aquí
        var button = document.querySelector('[data-id]'); // Selecciona el botón u otro elemento que tiene los atributos data-*
        if (button) {
            var id = button.getAttribute('data-id');
            var id_tienda_producto = button.getAttribute('data-id_tienda_producto');
            var fecha = button.getAttribute('data-fecha');
            var cantidad = button.getAttribute('data-cantidad');
            var costo = button.getAttribute('data-costo');
            var costo_total = button.getAttribute('data-costo_total');

            // Actualizar los valores en el formulario de la tarjeta
            cardEditarProducto.querySelector('#editar_id').value = id;
            cardEditarProducto.querySelector('#editar_id_tienda_producto').value = id_tienda_producto;
            cardEditarProducto.querySelector('#editar_fecha').value = fecha;
            cardEditarProducto.querySelector('#editar_cantidad').value = cantidad;
            cardEditarProducto.querySelector('#editar_costo').value = costo;
            cardEditarProducto.querySelector('#editar_costo_total').value = costo_total;
        }

        // Listener para el envío del formulario
        document.getElementById('formEditarProducto').addEventListener('submit', function(event) {
            // Validar el formulario aquí si es necesario
            if (!validarFormulario()) {
                event.preventDefault(); // Evita que el formulario se envíe si hay un error
                return false;
            }

            // Permitir que el formulario se envíe
            return true;
        });
    });

    function validarFormulario() {
        // Aquí puedes agregar cualquier validación personalizada que necesites
        return true; // Si todo está bien, retorna true para permitir el envío del formulario
    }
</script>