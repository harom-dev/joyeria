<?php

include_once("modelos/distribucion.php");
include_once("conexion.php");

class ControladorDistribucion
{
    public function inicio()
    {
        $id_tienda= $_SESSION['id_tienda'];
            $cargo= $_SESSION['id_cargo'];
        if ($cargo == 1) {
            $distribuciones = Distribucion::consultarXtienda($id_tienda);
            include_once("vistas/distribuciones/inicio.php");
        }else if($cargo == 3){
            $distribuciones = Distribucion::consultar();
            include_once("vistas/distribuciones/inicio.php");
        }else{
                print_r("No tiene permisos");
            }
       
    }

    public function crear()
    {
        // Crear un objeto DateTime con la fecha actual
       // $fecha = new DateTime();

        // Restar un día
       // $fecha->modify('-1 day');

        // Mostrar la fecha restada
        //echo $fecha->format('d/m/Y');


        //$fecha = date('Y-m-d');
        //print_r($fecha->format('d/m/Y'));
        if ($_POST) {
            $id_tienda = $_POST['id_tienda'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];
            $p_me = $_POST['p_me'];

            Distribucion::crear($id_tienda, $id_producto, $cantidad, $precio_unitario,$p_me);

            header("Location: ./?controlador=distribucion&accion=inicio");
        }
        $id_tienda= $_SESSION['id_tienda'];
            $cargo= $_SESSION['id_cargo'];
        if ($cargo == 1) {
            $tiendas = Distribucion::obtenerTiendasXid($id_tienda);
            $productos = Distribucion::obtenerProductos();
            $materiales = Distribucion::obtenerMateriales();
            include_once("vistas/distribuciones/crear.php");
        }else if($cargo == 3){
            $tiendas = Distribucion::obtenerTiendas();
            $productos = Distribucion::obtenerProductos();
            $materiales = Distribucion::obtenerMateriales();
        include_once("vistas/distribuciones/crear.php");
        }else{
                print_r("No tiene permisos");
            }
            
    }

    public function editar()
    {
        $id = $_GET['id'];
        $distribucion = Distribucion::productoPorId($id);
            if ($_POST) {
                $id_tienda = $_POST['id_tienda'];
                $id_producto = $_POST['id_producto'];
                $cantidad = $_POST['cantidad'];
                $precio_unitario = $_POST['precio_unitario'];
                $fecha = $_POST['fecha']; // a-mes-dia
                
                // Convierte la fecha de día/mes/año a año-mes-día
                //$fechaArray = explode('/', $fecha);
                //$fechaFormatoBD = $fechaArray[2] . '-' . $fechaArray[1] . '-' . $fechaArray[0];
                $fechaFormatoBD = $fecha;
                Distribucion::actualizar($id, $id_tienda, $id_producto, $cantidad, $precio_unitario, $fechaFormatoBD);

                header("Location: ./?controlador=distribucion&accion=inicio");
                }
                $id_tienda= $_SESSION['id_tienda'];
                $cargo= $_SESSION['id_cargo'];
                if ($cargo == 1) {
                        $tiendas = Distribucion::obtenerTiendasXid($id_tienda);
                        $productos = Distribucion::obtenerProductos();
                    include_once("vistas/distribuciones/editar.php");
                    }else if($cargo == 3){
                        $tiendas = Distribucion::obtenerTiendas();
                        $productos = Distribucion::obtenerProductos();
                        include_once("vistas/distribuciones/editar.php");
                }else{
                    print_r("No tiene permisos");
                }
        
    }

    public function borrar()
    {
        $id = $_GET['id'];
        Distribucion::borrar($id);
        header("Location: ./?controlador=distribucion&accion=inicio");
    }
}
?>
