<?php

include_once("modelos/producto.php"); // modelo
include_once("conexion.php"); // raiz index
BD::crearInstancia(); //trae la CLASE-metodo y ejecuta la conexion
class ControladorProductos
{
    public function inicio()
    {
        $productos=Producto::consultar();// mostrar el dato al modelo DB clase-metodo
        include_once("vistas/productos/inicio.php");
    }

    public function crear()
    {

        if($_POST){
            $foto = $_FILES['foto']['name'];
            if($foto!=""){
                $fecha_foto=new DateTime();
               $nombre_foto=$fecha_foto->getTimestamp()."_".$foto; //enviar a la tabla
               $tmp_foto=$_FILES["foto"]["tmp_name"];
               move_uploaded_file($tmp_foto,"vistas/images/producto/".$nombre_foto);
            }
            
            $id_material = $_POST['id_material'];
            $id_categoria = $_POST['id_categoria'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $medida = $_POST['medida'];
            $p_ma = $_POST['p_ma'];
            $peso = $_POST['peso'];

            Producto::crear($id_material,$id_categoria,$nombre,$descripcion,$medida,$p_ma,$peso,$nombre_foto);// envia el dato al modelo DB clase-metodo
             header("Location:./?controlador=productos&accion=inicio"); //regresa a la lista-misma pagina
        }
        $materiales = Producto::obtenerMateriales();
        $categorias = Producto::obtenerCategorias();
        include_once("vistas/productos/crear.php");
    }


    public function editar() 
    {
        $id=$_GET['id'];
        if($_POST){
            $nombre_foto =$_POST['antigua_foto']; // nombre de la foto antiguo
            $foto = $_FILES['foto']['name']; // nombre foto cargado o nuevo
               if($foto!="")
               {
                    // INICIA eliminar foto del disko
                    if(file_exists("vistas/images/producto/".$nombre_foto))
                    { // si existe file
                        unlink("vistas/images/producto/".$nombre_foto); //borra
                    }
                    // INICIA crea la foto
                $fecha_foto=new DateTime();
                $nombre_foto=$fecha_foto->getTimestamp()."_".$foto; //enviar a la tabla
                $tmp_foto=$_FILES["foto"]["tmp_name"];
                move_uploaded_file($tmp_foto,"vistas/images/producto/".$nombre_foto);
                }

          $id_material = $_POST['id_material'];
          $id_categoria = $_POST['id_categoria'];
          $nombre=$_POST['nombre'];
          $descripcion=$_POST['descripcion'];
          $medida=$_POST['medida'];
          $p_ma=$_POST['p_ma'];
          $peso=$_POST['peso'];
          Producto::editar($id,$id_material,$id_categoria,$nombre,$descripcion,$medida,$p_ma,$peso,$nombre_foto); // envia datos para modificar
         
          header("Location:./?controlador=productos&accion=inicio"); //regresar-mantener misma pagina
        }else{// solo muestra datos
        $Productos = Producto::obtenerPorId($id);
        $materiales = Producto::obtenerMateriales();
        $categorias = Producto::obtenerCategorias();
        include_once("vistas/productos/editar.php");
            }
    }

    public function borrar()
    {
        $id=$_GET['id'];
        Producto::borrar($id); // envia el dato al modelo(clase - modelo)

        header("Location:./?controlador=productos&accion=inicio"); //regresar-mantener misma pagina
    }
    
}
?>