<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("modelos/venta.php");
include_once("conexion.php");
BD::crearInstancia();

class ControladorVentas
{

    public function inicio()
    {

        $productos = ProductoVendido::obtenerProductoTienda();
        $productosVendidos = ProductoVendido::consultar();

        include_once("vistas/ventas/inicio.php");
    }

    public function crear()
    {
        $productos = ProductoVendido::obtenerProductoTienda();  // Esto llenará el select de productos
        $productosVendidos = ProductoVendido::consultar(); // No es necesario aquí pero lo dejo si se requiere
        // Verificar si la fecha está presente


        if ($_POST) {
        
            if (isset($_POST['fecha']) && !empty($_POST['fecha'])) {
                $fecha = $_POST['fecha'];
            } else {
                die('La fecha no está definida o está vacía.');
            }
            $productosVendidos = $_POST['productos'];

            if (empty($productosVendidos) || !is_array($productosVendidos)) {
                $error = 'Debe seleccionar al menos un producto';
                include_once("vistas/ventas/crear.php");
                return;
            }

            try {
                // Iniciar la transacción
                foreach ($productosVendidos as $producto) {
                    $id_tienda_producto = $producto['id_tienda_producto'];
                    $cantidad = $producto['cantidad'];
                    $costo = $producto['costo'];  
                    $costo_total = $producto['costo_total'];  

                    if (!is_numeric($cantidad) || $cantidad <= 0 || !is_numeric($costo) || !is_numeric($costo_total)) {
                        throw new Exception('Datos inválidos para el producto');
                    }
                    ProductoVendido::insertarProductoVendido($id_tienda_producto, $fecha, $cantidad, $costo, $costo_total);
                }

                header("Location: ./?controlador=ventas&accion=inicio");
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
                include_once("vistas/ventas/crear.php");
                return;
            }
        }

        // Mostrar la vista de creación si no hay datos POST
        include_once("vistas/ventas/crear.php");
    }


    public function editar()
    {
        // Verificar si la solicitud es POST, lo que indica que se envió el formulario
        if ($_POST) {
            // Obtener datos del formulario enviado
            $id = $_POST['id'] ?? null;
            $id_tienda_producto = $_POST['id_tienda_producto'] ?? null;
            $fecha = $_POST['fecha'] ?? null;
            $cantidad = $_POST['cantidad'] ?? null;
            $costo = $_POST['costo'] ?? null;
            $costo_total = $_POST['costo_total'] ?? null;

            var_dump($id, $id_tienda_producto, $fecha, $cantidad, $costo, $costo_total);

            // Verificar si todos los campos requeridos están presentes
            if ($id && $id_tienda_producto && $fecha && $cantidad && $costo && $costo_total) {
                // Actualizar el producto vendido en la base de datos
                ProductoVendido::editarProductoVendido($id, $id_tienda_producto, $fecha, $cantidad, $costo, $costo_total);

                // Redirigir a la página de inicio después de la actualización exitosa
                header("Location: ./?controlador=ventas&accion=inicio&exito=producto_actualizado");
                exit;
            } else {
                // Redirigir a la página de edición con un mensaje de error si faltan campos
                header("Location: ./?controlador=ventas&accion=editar&id={$id}&error=faltan_campos");
                exit;
            }
        }

        // Si no es una solicitud POST, cargar los datos para mostrar el formulario de edición
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener todos los productos vendidos
            $productosVendidos = ProductoVendido::consultar();

            // Filtrar el producto específico que se va a editar
            $productoSeleccionado = null;
            foreach ($productosVendidos as $producto) {
                if ($producto['id'] == $id) {
                    $productoSeleccionado = $producto;
                    break;
                }
            }

            // Verificar si el producto existe
            if (!$productoSeleccionado) {
                // Redirigir si el producto no existe
                header("Location: ./?controlador=ventas&accion=inicio&error=producto_no_encontrado");
                exit;
            }

            // Obtener la lista de productos en la tienda para el combo box
            $productos = ProductoVendido::obtenerProductoTienda();

            // Cargar la vista del formulario de edición
            include_once("vistas/ventas/editar.php");
        } else {
            // Redirigir a la página de inicio si no se proporciona un ID
            header("Location: ./?controlador=ventas&accion=inicio");
            exit;
        }
    }

    public function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                // Llama al método del modelo para eliminar el producto vendido
                ProductoVendido::eliminarProductoVendido($id);

                // Redirigir después de eliminar
                header("Location: ./?controlador=ventas&accion=inicio");
                exit;
            } else {
                // Manejar el caso en el que no se proporcione un ID válido
                header("Location: ./?controlador=ventas&accion=inicio");
                exit;
            }
        } else {
            // Manejar las solicitudes GET (en caso de que se acceda a esta función de forma incorrecta)
            header("Location: ./?controlador=ventas&accion=inicio");
            exit;
        }
    }
}
