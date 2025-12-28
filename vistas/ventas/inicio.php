<!-- Mostrar lista de productos vendidos -->
<div class="card">
    <div class="card-header">
        <a href="?controlador=ventas&accion=crear" class="btn btn-outline-success">
            vender Producto
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Tienda</th>
                        <TH>Producto</TH>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                        <th>Costo Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 1;
                    foreach ($productosVendidos as $producto) { ?>
                        <tr>
                            <td><?php echo $contador++; ?></td>
                            <td><?php echo $producto['tienda_nombre']; ?></td>
                            <td><?php echo $producto['producto_nombre']; ?></td>
                            <td><?php echo $producto['fecha']; ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td><?php echo $producto['costo']; ?></td>
                            <td><?php echo $producto['costo_total']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <!-- Formulario para editar -->
                                    <form action="?controlador=ventas&accion=editar" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                    </form>
                                    <!-- Formulario para borrar -->
                                    <form action="?controlador=ventas&accion=eliminar" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto vendido?');" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
