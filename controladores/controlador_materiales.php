<?php

include_once("modelos/material.php"); // modelo
include_once("conexion.php"); // raiz index
BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion
class ControladorMateriales
{
    public function inicio()
    {
        $materiales=Material::consultar();// mostrar el dato al modelo DB clase-metodo
        include_once("vistas/materiales/inicio.php");
    }

    public function crear()
    {

        if($_POST){
            $nombre = $_POST['nombre'];

            Material::crear($nombre);// envia el dato al modelo DB clase-metodo

            header("Location:./?controlador=materiales&accion=inicio"); //regresa a la lista-misma pagina
        }
        include_once("vistas/materiales/crear.php");
    }


    public function editar() // solo muestra datos
    {
        if($_POST){
            $id=$_POST['id'];
            $nombre=$_POST['nombre'];
            
            Material::editar($id,$nombre); // envia datos para modificar
            header("Location:./?controlador=materiales&accion=inicio"); //regresar-mantener misma pagina
        }else{
        $id=$_GET['id'];
        $materiales= Material::buscar($id); //envia datos muestra contenido de la tabla
        include_once("vistas/materiales/editar.php");
            }
    }

    public function borrar()
    {
        $id=$_GET['id'];

        Material::borrar($id); // envia el dato al modelo(clase - modelo)

        header("Location:./?controlador=materiales&accion=inicio"); //regresar-mantener misma pagina
    }
    
}
?>