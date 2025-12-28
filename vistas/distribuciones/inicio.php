<!-- Vista para listar las distribuciones -->
<div class="card">
    <div class="card-header">
        <a href="?controlador=distribucion&accion=crear" class="btn btn-outline-success">Agregar Distribución</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tienda</th>
                        <th>Producto</th>
                        <th>Material</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($distribuciones as $distribucion) { ?>
                        <tr>
                            <td><?php echo $distribucion->id; ?></td>
                            <td><?php echo $distribucion->nombre_tienda; ?></td>
                            <td><?php echo $distribucion->nombre_producto; ?></td>
                            <td><?php echo $distribucion->nombre_material; ?></td>
                            <td><?php echo $distribucion->nombre_categoria; ?></td>
                            <td><?php echo $distribucion->cantidad; ?></td>
                            <td><?php echo $distribucion->precio_unitario; ?></td>
                            <td><?php echo htmlspecialchars($distribucion->fecha, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>            
                                <a href="?controlador=distribucion&accion=editar&id=<?php echo $distribucion->id; ?>" class="btn btn-primary">Editar</a>
                                <a href="?controlador=distribucion&accion=borrar&id=<?php echo $distribucion->id; ?>" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
