<!-- mostrara lista registo -->
<div class="card">
    <div class="card-header">

    <a href="?controlador=productos&accion=crear" type="button" class="btn btn-outline-success" role="button">Agregar Productos</a>

    </div>
    <div class="card-body">
        

    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">MATERIAL</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">PRODUCTO</th>
                <th scope="col">DESCRIPCION</th>
                <th scope="col">MEDIDA</th>
                <th scope="col">PESO</th>
                <th scope="col">FOTO</th>
                <th scope="col">ACCIONES</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto){ ?>
            <tr class="">
                    <td><?php echo $producto->nom_material; ?></td>
                    <td><?php echo $producto->nom_categoria; ?></td>
                    <td><?php echo $producto->nombre; ?></td>
                    <td><?php echo $producto->descripcion; ?></td>
                    <td><?php echo $producto->medida;; ?></td>
                    <td><?php echo $producto->peso; ?></td>
                    <td><img src="vistas/images/producto/<?php echo $producto->foto; ?>" width="40" alt=""></td>
                        <td>
                            <div class="d-group">
                                <a href="?controlador=productos&accion=editar&id=<?php echo $producto->id; ?>" class="btn btn-primary">Editar</a>
                                <a href="?controlador=productos&accion=borrar&id=<?php echo $producto->id; ?>" class="btn btn-danger" >Borrar</a>
                            </div>
                        </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



    </div>
</div>