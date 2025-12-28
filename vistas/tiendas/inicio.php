<!-- mostrara lista registo -->
<div class="card">
    <div class="card-header">

    <a href="?controlador=tiendas&accion=crear" type="button" class="btn btn-outline-success" role="button">Agregar Tiendas</a>

    </div>
    <div class="card-body">
        

    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">DIRECCION</th>
                <th scope="col">DEPARTAMENTO</th>
                <th scope="col">PROVINCIA</th>
                <th scope="col">DISTRITO</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tiendas as $tienda){ ?>
            <tr class="">
                    <td><?php echo $tienda->id; ?></td>
                    <td><?php echo $tienda->nombre; ?></td>
                    <td><?php echo $tienda->direccion; ?></td>
                    <td><?php echo $tienda->departamento; ?></td>
                    <td><?php echo $tienda->nom_provincia; ?></td>
                    <td><?php echo $tienda->nom_distrito; ?></td>
                        <td>
                            <div class="d-group">
                                <a href="?controlador=tiendas&accion=editar&id=<?php echo $tienda->id; ?>" class="btn btn-primary">Editar</a>
                                <a href="?controlador=tiendas&accion=borrar&id=<?php echo $tienda->id; ?>" class="btn btn-danger" >Borrar</a>
                            </div>
                        </td>
                        
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



    </div>
</div>