<!-- mostrara lista registo -->
<div class="card">
    <div class="card-header">

    <a href="?controlador=usuarios&accion=crear" type="button" class="btn btn-outline-success" role="button">Agregar Usuarios</a>

    </div>
    <div class="card-body">
        

    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TIENDA</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">CORREO</th>
                <th scope="col">USUARIO</th>
                <th scope="col">CLAVE</th>
                <th scope="col">CARGO</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario){ ?>
            <tr class="">
                    <td><?php echo $usuario->id; ?></td>
                    <td><?php echo $usuario->nom_tienda; ?></td>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->celular; ?></td>
                    <td><?php echo $usuario->correo; ?></td>
                    <td><?php echo $usuario->usuario; ?></td>
                    <td>*****</td>
                    <td><?php echo $usuario->nom_cargo; ?></td>
                        <td>
                            <div class="d-group">
                                <a href="?controlador=usuarios&accion=editar&id=<?php echo $usuario->id; ?>" class="btn btn-primary">Editar</a>
                                <a href="?controlador=usuarios&accion=borrar&id=<?php echo $usuario->id; ?>" class="btn btn-danger" >Borrar</a>
                            </div>
                        </td>
                       
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



    </div>
</div>