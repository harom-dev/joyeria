<?php

include_once("modelos/categoria.php"); // modelo
include_once("conexion.php"); // raiz index
BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion
class ControladorCategorias
{
    public function inicio()
    {
        $categorias=Categoria::consultar();// mostrar el dato al modelo DB clase-metodo
        include_once("vistas/categorias/inicio.php");
    }

    public function crear()
    {

        if($_POST){
            $nombre = $_POST['nombre']; //cuando apreta grabar

            Categoria::crear($nombre);// envia el dato al modelo DB clase-metodo

            header("Location:./?controlador=categorias&accion=inicio"); //regresa a la lista-misma pagina
        }
        include_once("vistas/categorias/crear.php");
    }


    public function editar() // solo muestra datos
    {
        if($_POST){
            $id=$_POST['id'];
            $nombre=$_POST['nombre'];
            
            Categoria::editar($id,$nombre); // envia datos para modificar
            header("Location:./?controlador=categorias&accion=inicio"); //regresar-mantener misma pagina
        }else{
        $id=$_GET['id'];
        $materiales= Categoria::buscar($id); //envia datos muestra contenido de la tabla
        include_once("vistas/categorias/editar.php");
            }
    }

    public function borrar()
    {
        $id=$_GET['id'];

        Categoria::borrar($id); // envia el dato al modelo(clase - modelo)

        header("Location:./?controlador=categorias&accion=inicio"); //regresar-mantener misma pagina
    }
    
}
?>