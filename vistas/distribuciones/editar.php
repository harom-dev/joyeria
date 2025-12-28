<!-- Vista para editar una distribución existente -->
<div class="card">
    <div class="card-header">
        <h5>Editar Distribución</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            
            <div class="form-group">
                <label for="id_tienda">Tienda:</label>
                <select name="id_tienda" id="id_tienda" class="form-control" required>
                    <?php foreach ($tiendas as $tienda) { ?>
                        <option value="<?php echo $tienda['id']; ?>" <?php if ($distribucion[0]->nombre_tienda == $tienda['nombre']) echo 'selected'; ?>>
                            <?php echo $tienda['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_producto">Producto:</label>
                <select name="id_producto" id="id_producto" class="form-control" required>
                    <?php foreach ($productos as $producto) { ?>
                        <option value="<?php echo $producto['id']; ?>" <?php if ($distribucion[0]->nombre_producto == $producto['nombre']) echo 'selected'; ?>>
                            <?php echo $producto['nombre'] . ' (' . $producto['nombre_material'] . ', ' . $producto['nombre_categoria'] . ')'; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad(stock):</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?php echo $distribucion[0]->cantidad; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio_unitario">Precio de Venta:</label>
                <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" value="<?php echo $distribucion[0]->precio_unitario; ?>">
            </div>
            <div class="form-group">
                <label for="p_me">Precio al por Menor:</label>
                <input type="number" name="p_me" id="p_me" class="form-control" value="<?php echo $distribucion[0]->p_me; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo htmlspecialchars($distribucion[0]->fecha, ENT_QUOTES, 'UTF-8'); ?>">
            </div>                                                                     
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="?controlador=distribucion&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
        </form>
    </div>
</div>
