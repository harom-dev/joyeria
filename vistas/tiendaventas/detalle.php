<div class="container">
    <h2>Detalle del producto</h2>
    <?php if(isset($_SESSION["success"])):?>
        <div class="alert alert-success">
            <?php echo $_SESSION["success"] ?>
        </div>
    <?php unset($_SESSION["success"]); endif;?>  
    
    <?php if(isset($_SESSION["error_stock"])):?>
        <div class="alert alert-danger m-2">
            <?php echo $_SESSION["error_stock"] ?>
        </div>
    <?php unset($_SESSION["error_stock"]); endif;?> 
<div class="col-xl-5 col-lg-5 col-md-6 col-12 m-3">
            <div class="card"  >
              <?php
                $foto = $producto[0]->foto == 0 ? 'vistas/images/producto/producto_default.jpg':'vistas/images/producto/'.$producto[0]->foto;
               ?>
                <img src="<?php echo $foto; ?>" class="card-img-top"
                style="width: 400px;height: 400px;" alt="...">
                <div class="card-body">
                 <h4>Stock: <?php echo $producto[0]->cantidad ?></h4>
                <h5 class="card-title"><?php echo $producto[0]->nombre_producto."(".$producto[0]->nombre_tienda.")" ?></h5>
                <p class="card-text">Precio S/ <b><?php echo $producto[0]->precio_unitario; ?></b></p>
                 <form action="./index.php?controlador=tiendaventas&&accion=addCart" method="post">
                    <input type="hidden" name="id" value="<?php echo $producto[0]->id ?>">
                    <button class="btn btn-primary">comprar</button>
                    <a href="./index.php?controlador=tiendaventas&&accion=index">Volver a tienda</a>
                 </form>
                </div>
            </div>
        </div>
</div>