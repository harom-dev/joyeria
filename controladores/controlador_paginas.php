<?php
include_once("modelos/usuario.php"); // modelo
include_once("conexion.php"); // raiz index
BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion

class ControladorPaginas{
    
    public function inicio()
    {
    
        include_once("vistas/paginas/inicio.php");
    }

    public function error()
    {
        include_once("vistas/paginas/error.php");
    }

    public function obtener_usuario()
    {
        include_once("vistas/paginas/error.php");
    }


}

?>