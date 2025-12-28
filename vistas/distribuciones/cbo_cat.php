<?php
include_once("../../modelos/distribucion.php"); // Asegúrate de que la ruta sea correcta
include_once("../../conexion.php");

if (isset($_POST['id_material'])) {
    $id_material= $_POST['id_material'];
    $categorias = Distribucion::obtenerCategoriaPorMaterial($id_material); // Llama al método de la clase Distribucion

    foreach ($categorias as $categoria) {
        echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['categoria'] . '</option>';
    }
} else {
    echo '<option value="">No hay categorias disponibles</option>';
}
?>
