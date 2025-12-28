<?php
class Material{

    public $id;
    public $nombre;

public function __construct($id,$nombre)
{
    $this->id=$id;
    $this->nombre=$nombre;
}


        public static function consultar()
        {
            $listaMateriales=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->query("SELECT * FROM tbl_material");

            foreach ($sql->fetchall() as $material){
                $listaMateriales[]= new Material($material['id'],$material['nombre']); // se mete a la lista
            }
            return $listaMateriales;
        }
           
        public static function crear($nombre)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("INSERT INTO tbl_material(nombre) VALUES (?)");
                $sql->execute(array(ucwords($nombre)));
            }

            public static function borrar($id)
            {

                $conexionBD=BD::crearInstancia($id);

                $sql=$conexionBD->prepare("DELETE FROM tbl_material WHERE id=?");
                $sql->execute(array($id));
            }


            public static function buscar($id)
            {
                $conexionBD=BD::crearInstancia(); //conexion a la base
                $sql=$conexionBD->prepare("SELECT * FROM tbl_material where id=?");
                $sql->execute(array($id));

                
                    $empleado= $sql->fetch();
                
                return new Material($empleado['id'],$empleado['nombre']); //creando un objeto que contenga dato
            }


            public static function editar($id,$nombre)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("UPDATE tbl_material SET nombre=? WHERE id=?");
                $sql->execute(array(ucwords($nombre),$id));
            } 

        
}
?>