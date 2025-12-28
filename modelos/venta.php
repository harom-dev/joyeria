<?php

class ProductoVendido
{
    public $id;
    public $id_tienda_producto;
    public $fecha;
    public $cantidad;
    public $costo;
    public $costo_total;

    public function __construct($id, $id_tienda_producto, $fecha, $cantidad, $costo, $costo_total)
    {
        $this->id = $id;
        $this->id_tienda_producto = $id_tienda_producto;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
        $this->costo = $costo;
        $this->costo_total = $costo_total;
    }

    public static function insertarProductoVendido($id_tienda_producto, $fecha, $cantidad, $costo, $costo_total)
    {

        try {
            $conexionBD = BD::crearInstancia();
            $sql = $conexionBD->prepare("CALL InsertarProductoVendido(?, ?, ?, ?, ?)");
            $sql->execute([$id_tienda_producto, $fecha, $cantidad, $costo, $costo_total]);

            echo "<script>alert('Venta registrada exitosamente.');</script>";
        } catch (PDOException $error) {
            if ($error->getCode() == '45000') { // Código SQLSTATE que MySQL utiliza para SIGNAL

                echo "<script>
                      alert('Error: La cantidad a vender es mayor que la cantidad disponible en stock.');
                      window.history.back(); // Vuelve a la página anterior
                      </script>";
                exit;
            } else {
                // Manejar cualquier otro tipo de error de la base de datos
                echo "Error inesperado: " . $error->getMessage();
            }
        }
    }
    public static function obtenerProductoTienda()
    {
        $conexionBD = BD::crearInstancia();

        // Llamada al procedimiento almacenado para obtener los productos de la tienda
        $sql = $conexionBD->query("CALL obtenerProductoTienda()");

        $productos = [];

        // Recorrer los resultados y guardarlos en un array
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }

        return $productos;  // Devolver el array de productos
    }


    public static function editarProductoVendido($id, $id_tienda_producto, $fecha, $cantidad, $costo, $costo_total)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("CALL ModificarProductoVendido(?, ?, ?, ?, ?, ?)");
        $sql->execute([$id, $id_tienda_producto, $fecha, $cantidad, $costo, $costo_total]);
    }

    public static function consultar()
    {
        $listaProductosVendidos = [];
        $conexionBD = BD::crearInstancia();

        // Llamada al procedimiento almacenado para obtener todos los productos vendidos con detalles adicionales
        $sql = $conexionBD->query("CALL ObtenerProductosVendidos()");

        foreach ($sql->fetchAll(PDO::FETCH_ASSOC) as $producto) {
            $listaProductosVendidos[] = [
                'id' => $producto['id'],
                'id_tienda_producto' => $producto['id_tienda_producto'],
                'fecha' => $producto['fecha'],
                'cantidad' => $producto['cantidad'],
                'costo' => $producto['costo'],
                'costo_total' => $producto['costo_total'],
                'producto_nombre' => $producto['producto_nombre'],
                'tienda_nombre' => $producto['tienda_nombre']
            ];
        }

        return $listaProductosVendidos;
    }
    public static function eliminarProductoVendido($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = "CALL EliminarProductoVendido(?)";
        $stmt = $conexionBD->prepare($sql);
        $stmt->execute([$id]);
    }
}
