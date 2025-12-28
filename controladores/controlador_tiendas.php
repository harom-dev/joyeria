<?php

include_once("modelos/tienda.php"); // modelo
include_once("conexion.php"); // raiz index
BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion
class ControladorTiendas
{
    public function inicio()
    {
        $id_tienda= $_SESSION['id_tienda'];
        $cargo= $_SESSION['id_cargo'];
            if ($cargo == 1) {
                    $tiendas=Tienda::consultarXid($id_tienda);// mostrar el dato al modelo DB clase-metodo
                    include_once("vistas/tiendas/inicio.php");
                }else if($cargo == 3){
                    $tiendas=Tienda::consultar();// mostrar el dato al modelo DB clase-metodo
                    include_once("vistas/tiendas/inicio.php");
            }else{
                //print_r("No tiene permisos");
                //echo '<div class="alert alert-danger" role="alert"> NO TIENE PERMISOS! </div>';
            }
        
    }

    public function crear()
    {
        
        
        if($_POST){

            $logo = $_FILES['logo']['name'];
            print_r($_FILES);
                 if($logo!=""){
                     $fecha_logo=new DateTime();
                     $nombre_logo=$fecha_logo->getTimestamp()."_".$logo; //enviar a la tabla
                     $tmp_logo=$_FILES["logo"]["tmp_name"];
                     move_uploaded_file($tmp_logo,"vistas/images/otros/".$nombre_logo);
                 }else{
                    $nombre_logo="vacio.png";
                 }

             $nombre = $_POST['nombre'];
             $direccion = $_POST['direccion'];
             $departamento = $_POST['departamento'];
             $provincia = $_POST['provincia'];
             $distrito = $_POST['distrito'];

            Tienda::crear($nombre,$direccion,$departamento,$provincia,$distrito,$nombre_logo);// envia el dato al modelo DB clase-metodo
           header("Location:./?controlador=tiendas&accion=inicio"); //regresa a la lista-misma pagina
         }
        $provincias = Tienda::obtenerProvincia();
        include_once("vistas/tiendas/crear.php");
    }


    public function editar() // solo muestra datos
    {
        $id=$_GET['id'];
        
        if($_POST){
            $nombre_logo =$_POST['antigua_logo']; // nombre de la foto antiguo
            $logo = $_FILES['logo']['name']; // nombre foto cargado o nuevo
               if($logo!="")
               {
                    // INICIA eliminar foto del disko
                    if(file_exists("vistas/images/otros/".$nombre_logo))
                    { // si existe file
                        unlink("vistas/images/otros/".$nombre_logo); //borra
                    }
                    // INICIA crea la foto
                $fecha_logo=new DateTime();
                $nombre_logo=$fecha_logo->getTimestamp()."_".$logo; //enviar a la tabla
                $tmp_logo=$_FILES["logo"]["tmp_name"];
                move_uploaded_file($tmp_logo,"vistas/images/otros/".$nombre_logo);
                }


            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $departamento = $_POST['departamento'];
            $provincia = $_POST['provincia'];
            $distrito = $_POST['distrito'];
            Tienda::editar($id,$nombre,$direccion,$departamento,$provincia,$distrito,$nombre_logo); // envia datos para modificar
            header("Location:./?controlador=tiendas&accion=inicio"); //regresar-mantener misma pagina
        }else{
        //envia datos muestra contenido de la tabla
        $id=$_GET['id'];
        $tiendas= Tienda::buscar($id);
        $provincias = Tienda::obtenerProvincia();
        $distritos = Tienda::obtenerDistrito();
        include_once("vistas/tiendas/editar.php");
            }
    }

    public function borrar()
    {
        $id=$_GET['id'];

        Tienda::borrar($id); // envia el dato al modelo(clase - modelo)

        header("Location:./?controlador=tiendas&accion=inicio"); //regresar-mantener misma pagina
    }
    
}
?>