<?php

include_once("modelos/usuario.php"); // modelo
include_once("conexion.php"); // raiz index
BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion
class ControladorUsuarios
{
    public function inicio()
    {
        $id_tienda= $_SESSION['id_tienda'];
        $cargo= $_SESSION['id_cargo'];
        if ($cargo == 1) {
            $usuarios = Usuario::consultarXtienda($id_tienda); // Llama al método del modelo para obtener los usuarios
            include_once("vistas/usuarios/inicio.php"); // Carga la vista de inicio
    } else if($cargo == 3) {
            $usuarios=Usuario::consultar();// mostrar el dato al modelo DB clase-metodo
            include_once("vistas/usuarios/inicio.php");
    }else{
        print_r("No tiene permisos");
    }
    $usuarios="No hay datos";

    }

    public function crear()
    {

        if($_POST){
            $id_tienda = $_POST['id_tienda'];
            $nombre = $_POST['nombre'];
            $celular = $_POST['celular'];
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $id_cargo = $_POST['id_cargo'];

            Usuario::crear($id_tienda,$nombre,$celular,$usuario,$correo,$clave,$id_cargo);// envia el dato al modelo DB clase-metodo

            header("Location:./?controlador=usuarios&accion=inicio"); //regresa a la lista-misma pagina
        }
        $id_tienda= $_SESSION['id_tienda'];
        $cargo= $_SESSION['id_cargo'];
        if ($cargo == 1) {
            $tiendas = Usuario::obtenerTiendasXid($id_tienda);
            $cargos = Usuario::obtenerCargosAdmin();
            include_once("vistas/usuarios/crear.php");
         }else if($cargo == 3){
            $tiendas = Usuario::obtenerTiendas();
            $cargos = Usuario::obtenerCargos();
            include_once("vistas/usuarios/crear.php");
        }else{
        print_r("No tiene permisos");
        }

    }


    public function editar() // solo muestra datos
    {
        
        if($_POST){
            $id=$_POST['id'];
            $id_tienda = $_POST['id_tienda'];
            $nombre = $_POST['nombre'];
            $celular = $_POST['celular'];
            $usuario = $_POST['usuario'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $id_cargo = $_POST['id_cargo'];
                 
            Usuario::editar($id,$id_tienda,$nombre,$celular,$usuario,$correo,$clave,$id_cargo); // envia datos para modificar
            header("Location:./?controlador=usuarios&accion=inicio"); //regresar-mantener misma pagina
        }else{
            $id_tienda= $_SESSION['id_tienda'];
            $cargo= $_SESSION['id_cargo'];
            if ($cargo == 1) {
                $id=$_GET['id'];
                $usuarios= Usuario::buscar($id); //envia datos muestra contenido de la tabla
                $tiendas = Usuario::obtenerTiendasXid($id_tienda);
                $cargos = Usuario::obtenerCargosAdmin();
                include_once("vistas/usuarios/editar.php");
        }else if($cargo == 3){
            $id=$_GET['id'];
            $usuarios= Usuario::buscar($id); //envia datos muestra contenido de la tabla
            $tiendas = Usuario::obtenerTiendas();
            $cargos = Usuario::obtenerCargos();
            include_once("vistas/usuarios/editar.php");
        }else{
            print_r("No tiene permisos");
        }
            }
    }

    public function borrar()
    {
        $id=$_GET['id'];

        Usuario::borrar($id); // envia el dato al modelo(clase - modelo)

        header("Location:./?controlador=usuarios&accion=inicio"); //regresar-mantener misma pagina
    }
    
}
?>