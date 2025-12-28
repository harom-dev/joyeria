<?php
class Categoria{

    public $id;
    public $nombre;

public function __construct($id,$nombre)
{
    $this->id=$id;
    $this->nombre=$nombre;
}


        public static function consultar()
        {
            $listaCategorias=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->query("SELECT * FROM tbl_categoria");

            foreach ($sql->fetchall() as $categoria){
                $listaCategorias[]= new Categoria($categoria['id'],$categoria['nombre']); // se mete a la lista
            }
            return $listaCategorias;
        }
           
        public static function crear($nombre)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("INSERT INTO tbl_categoria(nombre) VALUES (?)");
                $sql->execute(array(ucwords($nombre)));
            }

            public static function borrar($id)
            {

                $conexionBD=BD::crearInstancia($id);

                $sql=$conexionBD->prepare("DELETE FROM tbl_categoria WHERE id=?");
                $sql->execute(array($id));
            }


            public static function buscar($id)
            {
                $conexionBD=BD::crearInstancia(); //conexion a la base
                $sql=$conexionBD->prepare("SELECT * FROM tbl_categoria where id=?");
                $sql->execute(array($id));

                
                    $empleado= $sql->fetch();
                
                return new Categoria($empleado['id'],$empleado['nombre']); //creando un objeto que contenga dato
            }


            public static function editar($id,$nombre)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("UPDATE tbl_categoria SET nombre=? WHERE id=?");
                $sql->execute(array(ucwords($nombre),$id));
            } 

        
}
?>