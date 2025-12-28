<!doctype html>
<html lang="en">
    <head>
        <title>La Joyeria</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
          <!-- uso de Jquery -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    
     </head>

    <body>
             
            <!-- BARRA DE NAVEGACIÓN -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <a class="nav-item nav-link active" href="?controlador=paginas&accion=inicio" aria-current="page"><img class="logo" src="vistas/images/otros/<?php echo saludar()->logo; ?>" alt="" width="100" height="40"> <!-- LOGO -->
                        <span class="visually-hidden">(current)</span>
                        </a>
                    <?php endif; ?>
                        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mi-menu">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mi-menu">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if(isset($_SESSION['usuario'])): ?> 
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Registrar
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="?controlador=productos&accion=inicio">Productos</a></li>
                                        <li><a class="dropdown-item" href="?controlador=tiendas&accion=inicio">Tiendas</a></li>
                                        <li><a class="dropdown-item" href="?controlador=categorias&accion=inicio">Categorias</a></li>
                                        <li><a class="dropdown-item" href="?controlador=materiales&accion=inicio">Materiales</a></li>
                                    </ul>
                                </li>
                                        <a class="nav-item nav-link" href="?controlador=distribucion&accion=inicio">Producto Por Tienda</a>
                                        <a class="nav-item nav-link" href="?controlador=ventas&accion=inicio">Ventas</a>
                                        <a class="nav-item nav-link" href="?controlador=controlMaterial&accion=inicio">Control de Material</a>
                                        <a class="nav-item nav-link" href="?controlador=usuarios&accion=inicio">Usuarios</a>
                                        <?php endif; ?>
                                       <?php if(isset($_SESSION['usuario'])): ?> 
                                        <a class="nav-item nav-link" href="?controlador=login&accion=logout">Cerrar Sesión</a>
                                        <?php endif; ?>
                                        <?php if(!isset($_SESSION['usuario'])): ?> 
                                        <a class="nav-item nav-link" href="?controlador=login&accion=logout">Login</a>
                                        <?php endif; ?>
                                    
                            </ul>
                            <?php if(isset($_SESSION["usuario"])):?>
                                <a href="./index.php?controlador=tiendaventas&&accion=listacarrito">
                                <i class="fas fa-cart-shopping mx-2">(<?php echo isset($_SESSION["cart"]) && count($_SESSION["cart"])>0 ?count($_SESSION["cart"]):0 ?>)</i>
                                </a>
                                <tr> 
                                <td> <?php echo isset(saludar()->nombre)?saludar()->nombre:""; ?> </td><br>
                                <td> <?php echo isset(saludar()->nom_cargo)?ucwords(saludar()->nom_cargo):""; ?> </td>
                            </tr>
                            <?php endif;?>    
                        </div>           
                    </div>
                </nav>
            <!-- FIN BARRA DE NAVEGACIÓN -->
 <!-- CUERPO -->
 <div class="banner-img" style="position:relative; background:url('vistas/images/otros/fondo1.png') center/cover no-repeat; height: 550px;"> <!-- FONDO -->
<br>
 <div class="container">
        <div class="row">
            <div class="row">
            <div class="col-12">
              <?php include_once("ruteador.php");  ?>
            </div>
            </div>
        </div>
    </div>
    
 <!-- FIN CUERPO --> 
    
<!-- para editar tienda distrito cascada -->
   <script src="vistas/ScriptsJS/cargarDistritos.js"></script>  
 <!-- Bootstrap JavaScript Libraries -->
 <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
<!-- implementar Jquery para todo los databable -->
<script>
            $(document).ready(function(){
                $('table').DataTable({
                    "pageLength":10,
                    lengthMenu:[
                        [6,10,25,50],
                        [6,10,25,50]
                    ],
                    "language":{
                        "url":"https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json"            
                                        }
                                    });
            });
</script>
  <!-- para editar tienda distrito cascada -->
  <!-- <script src="vistas/ScriptsJS/cargarDistritos.js"></script>  
  <script src="../node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.esm.all.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.esm.all.min.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.esm.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.esm.min.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
     
  </script>
    </body>
</html>
