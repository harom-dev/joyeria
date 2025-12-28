<div class="container">

    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <label for="tienda"><b>Buscar por tienda</b></label>
                <select name="tienda" id="tienda" class="form-select">
                    <option selected disabled>--- Seleccione una tienda ----</option>
                    <?php foreach ($tiendas as $tienda): ?>
                        <option value="<?php echo $tienda->id ?>"><?php echo $tienda->nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-auto">
            <div class="form-group">
                <label for="tienda"><b>Buscar por categoría</b></label>
                <select name="categoria" id="categoria" class="form-select">
                    <option selected disabled>--- Seleccione una categoría ----</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-auto">
            <div class="form-group">
                <label for="tienda"><b>Buscar</b></label>
                <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Nombre producto...">
            </div>
        </div>
    </div>
    <div class="row" id="tarjetadata">
    <?php if(isset($_SESSION["success"])):?>
        <div class="alert alert-success m-2">
            <?php echo $_SESSION["success"] ?>
        </div>
    <?php unset($_SESSION["success"]); endif;?>  

    <?php if(isset($_SESSION["error_stock"])):?>
        <div class="alert alert-danger m-2">
            <?php echo $_SESSION["error_stock"] ?>
        </div>
    <?php unset($_SESSION["error_stock"]); endif;?>  
    </div>
</div>
<!-- 
-->
<script>
    var CATEGORIAID; 
    $(document).ready(function() {
          filtrarProductos('');

        $('#tienda').change(function() {

            showProductos($(this).val(), "tienda");
        });

        $('#categoria').change(function() {
            CATEGORIAID = $(this).val();
            showProductos($(this).val(), "categoria");
        });

        $('#buscar').keyup(function() {
            if ($(this).val().length > 0) {
                filtrarProductos($(this).val());
            } else {
                showProductos(CATEGORIAID, "categoria");
            }
        });
    });

    /// mostrar los productos en la tienda
    function showProductos(data_id, opcdata) {

        let tarjeta = '';
        let foto;
        $.ajax({
            url: "controllers/controlador_logica.php?controlador=tiendaventas&&accion=mostrarproductos",
            method: "GET",
            data: {
                dataid: data_id,
                opc: opcdata
            },
            dataType: "json",
            success: function(response) {

                if (response.productos.length > 0) {
                    response.productos.forEach(producto => {

                        foto = producto.foto == 0 ? 'vistas/images/producto/producto_default.jpg' : 'vistas/images/producto/' + producto.foto;

                        tarjeta += `
                             <div class="col-xl-3 col-lg-4 col-md-6 col-12 m-3">
                             <div class="card" style="width: 18rem;">
                           
                             <img src="` + foto + `" class="card-img-top" alt="..."
                             style="width: 240px;height: 240px;">
                             <div class="card-body">
                             <h5 class="card-title">` + producto.nombre_producto + `(` + producto.nombre_tienda + `)</h5>
                             <p class="card-text">Precio S/ <b>` + producto.precio_unitario + `</b></p>
                           <form action="./index.php?controlador=tiendaventas&&accion=addCart" method="post">
                               <input type="hidden" name="id" value=`+producto.id+`>
                               <button class="btn btn-primary" name='comprar_index'>comprar</button>
                            </form>
                             <a href="./index.php?controlador=tiendaventas&&accion=detalle&&prod=` + producto.id + `" class="btn btn-warning btn-sm">ver detalles</a>
                             </div>
                             </div>
                             </div>
                             `;
                    });
                } else {
                    tarjeta = '<div class="alert alert-danger mt-4">No hay productos para mostrar....</div>';
                }
                $('#tarjetadata').html(tarjeta);

            }
        })
    }


    /// filtrar

    function filtrarProductos(search) {
        let tarjeta = '';
        let foto;
        $.ajax({
            url: "controllers/controlador_logica.php?controlador=tiendaventas&&accion=buscar",
            method: "GET",
            data: {
                buscar: search
            },
            dataType: "json",
            success: function(response) {

                if (response.productos.length > 0) {
                    response.productos.forEach(producto => {

                        foto = producto.foto == 0 ? 'vistas/images/producto/producto_default.jpg' : 'vistas/images/producto/' + producto.foto;

                        tarjeta += `
                             <div class="col-xl-3 col-lg-4 col-md-6 col-12 m-3">
                             <div class="card" style="width: 18rem;">
                           
                             <img src="` + foto + `" class="card-img-top" alt="..."
                             style="width: 240px;height: 240px;">
                             <div class="card-body">
                             <h5 class="card-title">` + producto.nombre_producto + `(` + producto.nombre_tienda + `)</h5>
                             <p class="card-text">Precio S/ <b>` + producto.precio_unitario + `</b></p>
                             <a href="#" class="btn btn-primary btn-sm">comprar</a>
                             <a href="./index.php?controlador=tiendaventas&&accion=detalle&&prod=` + producto.id + `" class="btn btn-warning btn-sm">ver detalles</a>
                             </div>
                             </div>
                             </div>
                             `;
                    });
                } else {
                    tarjeta = '<div class="alert alert-danger mt-4">No hay productos para mostrar....</div>';
                }
                $('#tarjetadata').html(tarjeta);

            }
        })
    }
</script>