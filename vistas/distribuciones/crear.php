<!-- Vista para agregar una nueva distribución -->
<div class="card">
    <div class="card-header">
        <h5>Agregar Distribución</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="id_tienda">Tienda:</label>
                <select name="id_tienda" id="id_tienda" class="form-control" required>
                    <option value="">Seleccionar Tienda</option>
                    <?php foreach ($tiendas as $tienda) { ?>
                        <option value="<?php echo $tienda['id']; ?>"><?php echo $tienda['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="id_material">Material:</label>
                <select name="id_material" id="id_material" class="form-control" required>
                    <option value="">Seleccionar Material</option>
                    <?php foreach ($materiales as $material) { ?>
                        <option value="<?php echo $material['id']; ?>"><?php echo $material['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Categoria:</label>
                <select name="id_categoria" id="id_categoria" class="form-control" required>
                    <option value="">Seleccionar Categoria</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Producto:</label>
                <select name="id_producto" id="id_producto" class="form-control" required>
                    <option value="">Seleccionar Producto</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="cantidad">Cantidad (stock):</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="precio_unitario">Precio de Venta:</label>
                <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="p_me">Precio al por Menor:</label>
                <input type="number" name="p_me" id="p_me" class="form-control" required>
                <br>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="?controlador=distribucion&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#id_material").change(function() {
        var id_material = $(this).val();
        if (id_material) {
            $.post("vistas/distribuciones/cbo_cat.php", { id_material: id_material }, function(data) {
                $("#id_categoria").html(data);
                $("#id_producto").html('<option value="">Seleccionar Producto</option>'); // Reinicia el combo de productos
            });
        } else {
            $("#id_categoria").html('<option value="">Seleccionar Categoria</option>');
            $("#id_producto").html('<option value="">Seleccionar Producto</option>'); // Reinicia el combo de productos
        }
    });

    $("#id_categoria").change(function() {
        var id_categoria = $(this).val();
        var id_material = $("#id_material").val(); // Obtener el material seleccionado
        if (id_categoria && id_material) {
            $.post("vistas/distribuciones/cbo_prod.php", { id_material: id_material, id_categoria: id_categoria }, function(data) {
                $("#id_producto").html(data);
            });
        } else {
            $("#id_producto").html('<option value="">Seleccionar Producto</option>');
        }
    });
});
</script>
