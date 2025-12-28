<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center fw-bold"><strong>Detalle General del Material</strong></div>
        <div class="card-body">
            <form id="formInsertarProductoVenta" action="?controlador=ventas&accion=crear" method="post">
            <input type="hidden" class="form-control" value="<?php echo $MaterialResumenes_r[0]->id_resume; ?>" name="id" id="id" aria-describedby="helpId" placeholder="Escriba el ID"/><!-- almacena y no muestra el iD-->    

                <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto:</label>
                <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $MaterialResumenes_r[0]->nombre; ?>"readonly/>
                </div>

                <div class="mb-3">
                <label for="nombre" class="form-label">Descripción:</label>
                <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $MaterialResumenes_r[0]->descripcion; ?>"readonly/>
                </div>

                <div class="mb-3">
                    <label for="id" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad"value="<?php echo $MaterialResumenes_r[0]->cantidad; ?>"readonly/>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $MaterialResumenes_r[0]->fecha; ?>"readonly>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <button type="button" id="add-product-btn" class="btn btn-primary">Editar el Control de Material</button>
                </div>

                <table class="table table-striped" id="productos-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>FECHA REG.</th>
                            <th>MATERIAL E.</th>
                            <th>MATERIAL P.</th>
                            <th>ESTADO M.</th>
                            <th>COSTO MO.</th>
                            <th>PAGADO MO.</th>
                            <th>DEBE MO.</th>
                            <th>ESTADO MO.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $MaterialDetalles as $MaterialesDetalle) { ?>
                            <tr>
                                <td><?php echo $MaterialesDetalle->id_detalle; ?></td>
                                <td><?php echo $MaterialesDetalle->fecha; ?></td>
                                <td><?php echo $MaterialesDetalle->MATERIAL_ENTREGADO; ?></td>
                                <td><?php echo $MaterialesDetalle->MATERIAL_PRESTADO; ?></td>
                                <td><?php echo $MaterialesDetalle->MATERIAL_ESTADO; ?></td>
                                <td><?php echo $MaterialesDetalle->MANO_OBRA_COSTO; ?></td>
                                <td><?php echo $MaterialesDetalle->MANO_OBRA_PAGADO; ?></td>
                                <td><?php echo $MaterialesDetalle->MANO_OBRA_DEBE; ?></td>
                                <td><?php echo $MaterialesDetalle->MANO_OBRA_ESTADO; ?></td>
                                <td>
                                    <a href="?controlador=controlMaterial&accion=editar&id=<?php echo  $MaterialesDetalle->id_detalle; ?>" class="btn btn-success">Editar</a>
                                    <a href="?controlador=controlMaterial&accion=borrar&id=<?php echo  $MaterialesDetalle->id_detalle; ?>" class="btn btn-danger">Borrar</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="2" class="text-right"><strong>Total:</strong></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MATERIAL_ENTREGADO; ?></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MATERIAL_PRESTADO; ?></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MATERIAL_ESTADO; ?></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MANO_OBRA_COSTO; ?></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MANO_OBRA_PAGADO; ?></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MANO_OBRA_DEBE; ?></td>
                            <td id="total-costo"><?php echo $MaterialResumenes_r[0]->MANO_OBRA_ESTADO; ?></td>
                            <td></td>
                        </tr>

                    </tfoot>
                </table>


                <br>

                <div class="mb-3 d-flex justify-content-between">
                    <a href="?controlador=controlMaterial&accion=inicio" class="btn btn-danger mx-auto">Cancelar</a>
                </div>

            </form>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
</div>
