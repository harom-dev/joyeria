<?php
include_once("modelos/distritoPorProvincia.php"); // modelo
include_once("conexion.php"); // BD
class ControladorDistritoPorProvincia {

    public function cargarDistritos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['provincia_id'])) {
            $provincia_id = $_POST['provincia_id'];
            $distritos = DistritosPorProvincia::obtenerDistritosPorProvincia($provincia_id);
            echo"<option value='"."'>".'Seleccione Distrito'."</option>";
            // Devolver la respuesta a la vista
            foreach ($distritos as $distrito) {
                echo "<option value='" . $distrito['id'] . "'>" . $distrito['nombre'] . "</option>";
            }
        }
    }
}