<?php
///echo $controlador;echo "<br>";
//echo $accion;
    include_once("controladores/controlador_".$controlador.".php"); //direccion de carpeta y archivo PHP
    $objControlador="Controlador".ucfirst($controlador); // crea nombre de la clase
    $controlador = new $objControlador(); // llama a la clase
    $controlador->$accion(); // llama Metodo
?>