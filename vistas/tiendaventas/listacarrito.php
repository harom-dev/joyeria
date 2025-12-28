
<div class="container">
    <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0): ?>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <td>imagen</th>
                            <th>Tienda</th>
                            <th>producto</th>
                            <th>precio</th>
                            <th>cantidad</th>
                            <th>importe</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0): $contador = 0;
                            $importe = 0.00;
                            $TotalPago = 0.00; ?>

                            <?php foreach ($_SESSION["cart"] as $index => $carrito): $contador++;
                                $foto = $carrito["foto"] == 0 ? 'vistas/images/producto/producto_default.jpg' : 'vistas/images/producto/' . $carrito["foto"];
                                $importe = $carrito["precio"] * $carrito["cantidad"];
                                $TotalPago += $importe;
                            ?>
                                <tr>
                                    <td><?php echo $contador ?></td>
                                    <td>
                                        <img src="<?php echo $foto; ?>" alt="" style="width: 80px;height: 80px;">
                                    </td>
                                    <td><?php echo $carrito["tienda"]; ?></td>
                                    <td><?php echo $carrito["producto"] ?></td>
                                    <td><?php echo $carrito["precio"] ?></td>
                                    <td><?php echo $carrito["cantidad"] ?></td>
                                    <td><?php echo number_format($importe, 2, ',', ' ') ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminado(`<?php echo $index ?>`,`<?php echo $carrito['producto'] ?>`)"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </tbody>
                </table>
                <br>
                <form action="./index.php?controlador=tiendaventas&&accion=limpiarcarrito" method="post">
                    <button class="btn btn-danger">Vaciar carrito</button>
                </form>
                <a href="./index.php?controlador=tiendaventas&&accion=index">Ir a comprar más</a>
                <h1>Total a pagar : <?php echo $TotalPago; ?></h1>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            No hay productos añadidos al carrito....
            <a href="./index.php?controlador=tiendaventas&&accion=index">Ir a comprar</a>
        </div>
    <?php endif; ?>
</div>

<script>
    
    $(document).ready(function(){
        
      
    });
    function confirmarEliminado(id,nombreproducto) {
        Swal.fire({
            title: "Estas seguro de eliminar al producto "+nombreproducto+" del carrito?",
            text: "Al aceptar, se borrara y no podrás recuperar!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
               deleteProductoCarrito(id);
               location.href='./index.php?controlador=tiendaventas&&accion=listacarrito';  
            }
        });
    }


    function deleteProductoCarrito(iddata)
    {
      $.ajax({
        url:"./index.php?controlador=tiendaventas&&accion=quitarproducto",
        method:"POST",
        data:{
            id:iddata
        },
        dataType:"json",
        success:function(response){
       
        }
      });
    }

    /**mostrar productos */
     
</script>