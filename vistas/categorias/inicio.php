<!-- mostrara lista registo -->
<div class="card">
    <div class="card-header">

    <a href="?controlador=categorias&accion=crear" type="button" class="btn btn-outline-success" role="button">Agregar Categoria</a>

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
            <?php foreach($categorias as $categoria){ ?>
            <tr class="">
                <td><?php echo $categoria->id; ?></td>
                <td><?php echo $categoria->nombre; ?></td>
                <td>
                    <div class="d-group">
                    <a href="?controlador=categorias&accion=editar&id=<?php echo $categoria->id; ?>" class="btn btn-primary">Editar</a>
                    <a href="?controlador=categorias&accion=borrar&id=<?php echo $categoria->id; ?>" class="btn btn-danger" >Borrar</a>
                    
                    </div>
                </td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



    </div>
</div>