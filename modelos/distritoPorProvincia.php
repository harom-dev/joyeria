<?php
class DistritosPorProvincia {
    
    public $provincia_id;

    public function __construct($provincia_id)
    {
        $this->provincia_id = $provincia_id;
        
    }

    public static function obtenerDistritosPorProvincia($provincia_id) {
        $conexionBD = BD::crearInstancia(); // Conexión a la base de datos

        $query = "SELECT id, nombre FROM tbl_distrito WHERE id_provincia = :provincia_id";
        $stmt = $conexionBD->prepare($query);
        $stmt->bindParam(':provincia_id', $provincia_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
