<?php
include_once("../../modelos/distribucion.php");
include_once("../../conexion.php");

if (isset($_POST['id_material']) && isset($_POST['id_categoria'])) {
    $id_material = $_POST['id_material'];
    $id_categoria = $_POST['id_categoria'];

    $productos = Distribucion::obtenerProductosPorCategoriaYMaterial($id_material, $id_categoria); // Asegúrate de que este método esté implementado

    if ($productos) {
        foreach ($productos as $producto) {
            echo '<option value="' . $producto['id_producto'] . '">' . $producto['nombre_producto'] . '</option>';
        }
    } else {
        echo '<option value="">No hay productos disponibles</option>';
    }
} else {
    echo '<option value="">No hay productos disponibles</option>';
}
?>
