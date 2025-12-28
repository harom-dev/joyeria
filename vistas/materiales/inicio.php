<!-- mostrara lista registo -->
<div class="card">
    <div class="card-header">

    <a href="?controlador=materiales&accion=crear" type="button" class="btn btn-outline-success" role="button">Agregar Materiales</a>

    </div>
    <div class="card-body">
        

    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($materiales as $material){ ?>
            <tr class="">
                <td><?php echo $material->id; ?></td>
                    <td><?php echo $material->nombre; ?></td>
                        <td>
                            <div class="d-group">
                                <a href="?controlador=materiales&accion=editar&id=<?php echo $material->id; ?>" class="btn btn-primary">Editar</a>
                                <a href="?controlador=materiales&accion=borrar&id=<?php echo $material->id; ?>" class="btn btn-danger" >Borrar</a>
                            </div>
                        </td>   
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



    </div>
</div>