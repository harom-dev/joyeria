<?php
include_once("modelos/controlMaterial.php");
include_once("modelos/producto.php"); // modelo
include_once("conexion.php");
include_once("modelos/distribucion.php");
class ControladorControlMaterial
{
    public function inicio()
    {
        
        $MaterialResumenes = ControlMaterial::consultar(); 
         
        include_once("vistas/controlMaterial/inicio.php");
    }

    public function ver()
    {
        $id = $_GET['id'];
        $MaterialResumenes_r = ControlMaterial::consultar_resumen($id);
        $MaterialDetalles = ControlMaterial::obtenerPorId($id);

        include_once("vistas/controlMaterial/ver.php");
    }

    public function crear()
    {
        if ($_POST) {
            $id_tienda = $_POST['id_tienda'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $precio_unitario = $_POST['precio_unitario'];

            Distribucion::crear($id_tienda, $id_producto, $cantidad, $precio_unitario);

            header("Location: ./?controlador=distribucion&accion=inicio");
        }

        $tiendas = Distribucion::obtenerTiendas();
        $productos = Distribucion::obtenerProductos();
        include_once("vistas/distribuciones/crear.php");
    }

    public function editar()
    {
        $id = $_GET['id'];
      
  
            if ($_POST) {      
                $id_tienda = $_POST['id_tienda'];
                $id_producto = $_POST['id_producto'];
                $cantidad = $_POST['cantidad'];
                $precio_unitario = $_POST['precio_unitario'];
                $fecha = $_POST['fecha'];

                // Convierte la fecha de día/mes/año a año-mes-día
                $fechaArray = explode('/', $fecha);
                $fechaFormatoBD = $fechaArray[2] . '-' . $fechaArray[1] . '-' . $fechaArray[0];

                Distribucion::actualizar($id, $id_tienda, $id_producto, $cantidad, $precio_unitario, $fechaFormatoBD);

                header("Location: ./?controlador=distribucion&accion=inicio");
                }
        
         $distribucion = Distribucion::obtenerPorId($id);
         
         $tiendas = Distribucion::obtenerTiendas();
       
         $productos = Distribucion::obtenerProductos();
     
        include_once("vistas/distribuciones/editar.php");
    }

    public function borrar()
    {
        $id = $_GET['id'];
        Distribucion::borrar($id);
        header("Location: ./?controlador=distribucion&accion=inicio");
    }
}
?>
