<!-- Vista para listar las distribuciones -->
<div class="card">
    <div class="card-header">
        <a href="?controlador=controlMaterial&accion=crear" class="btn btn-outline-success">Crear Control de Material</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CANT.</th>
                        <th>TOTAL (g)</th>
                        <th>ESTADO</th>
                        <th>COSTO M.O</th>
                        <th>ESTADO M.O</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($MaterialResumenes as $MaterialResume) { ?>
                        <tr>
                            <td><?php echo $MaterialResume->id_resume; ?></td>
                            <td><?php echo $MaterialResume->nombre; ?></td>
                            <td><?php echo $MaterialResume->descripcion; ?></td>
                            <td><?php echo $MaterialResume->cantidad; ?></td>
                            <td><?php echo $MaterialResume->MATERIAL_ENTREGADO; ?></td>
                            <td><?php echo $MaterialResume->MATERIAL_ESTADO; ?></td>
                            <td><?php echo $MaterialResume->MANO_OBRA_COSTO; ?></td>
                            <td><?php echo $MaterialResume->MANO_OBRA_ESTADO; ?></td>
                            <td>
                                <a href="?controlador=controlMaterial&accion=ver&id=<?php echo $MaterialResume->id_resume; ?>" class="btn btn-primary">Detalle</a>
                                <a href="?controlador=controlMaterial&accion=borrar&id=<?php echo $MaterialResume->id_resume; ?>" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
