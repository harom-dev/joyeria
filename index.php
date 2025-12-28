<?php
ob_start();
if(session_status() != PHP_SESSION_ACTIVE){
session_start();
}

//Verificar si el usuario está autenticado, excepto en el login
if (!isset($_SESSION['usuario']) && !($_GET['controlador'] === 'login' && $_GET['accion'] === 'login')) {
   header("Location:index.php?controlador=login&accion=login");
   exit;
}

include_once("modelos/usuario.php"); // modelo
include_once("conexion.php"); // raiz index

BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion
function saludar(){
  if(isset($_SESSION['usuario']))
  {
  $usuario= $_SESSION ['usuario'];
  $dato_usuario=Usuario::buscar($usuario);
  return $dato_usuario;
  }

}

$controlador="paginas"; // carpeta - por defcto
$accion="inicio"; // metodo - por defecto
// SI APRETÓ ALGUN BOTON
if (isset($_GET['controlador']) && isset($_GET['accion'])){

    if(($_GET['controlador']!="")&& ($_GET['accion']!="")) // si son dfernete de vacion entra - se cambia las variables
        {
        $controlador = $_GET['controlador'];
        $accion = $_GET['accion'];
        }
}// FIN APRETÓ ALGUN BOTON
 require_once("vistas/template.php");
 ob_end_flush();
?>