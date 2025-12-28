<?php
class Producto{

    public $id;
    public $id_material;
    public $nom_material;
    public $id_categoria;
    public $nom_categoria;
    public $nombre;
    public $foto;
    public $descripcion;
    public $medida;
    public $p_ma;
    public $peso;

public function __construct($id,$id_material,$id_categoria,$nombre,$descripcion,$medida,$p_ma,$peso,$foto,$nom_material,$nom_categoria)
{
    $this->id=$id;
    $this->id_material=$id_material;
    $this->nom_material=$nom_material;
    $this->id_categoria=$id_categoria;
    $this->nom_categoria=$nom_categoria;
    $this->nombre=$nombre;
    $this->foto=$foto;
    $this->descripcion=$descripcion;
    $this->medida=$medida;
    $this->p_ma=$p_ma;
    $this->peso=$peso;
}


        public static function consultar()
        {
            $listaProductos=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->query("SELECT p.*,m.nombre AS nom_material,c.nombre AS nom_categoria FROM tbl_producto as p
                                        LEFT JOIN (SELECT * FROM tbl_material) AS m
                                        ON p.id_material=m.id
                                        LEFT JOIN (SELECT * FROM tbl_categoria) AS c
                                        ON p.id_categoria=c.id;");

            foreach ($sql->fetchall() as $producto){
                $listaProductos[]= new Producto($producto['id'],$producto['id_material'],$producto['id_categoria'],$producto['nombre'],$producto['descripcion'],$producto['medida'],$producto['p_ma'],$producto['peso'],$producto['foto'],$producto['nom_material'],$producto['nom_categoria']); // se mete a la lista
            }
            return $listaProductos;
        }
           
        public static function crear($id_material,$id_categoria,$nombre,$descripcion,$medida,$p_ma,$peso,$nombre_foto)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("INSERT INTO tbl_producto(id_material,id_categoria,nombre,descripcion,medida,p_ma,peso,foto) VALUES (?,?,?,?,?,?,?,?)");
                $sql->execute(array($id_material,$id_categoria,ucwords($nombre),$descripcion,$medida,$p_ma,$peso,$nombre_foto));
            }

            public static function borrar($id)
            {

                $conexionBD=BD::crearInstancia($id);

                // INICIA eliminar foto del disko
                $sql=$conexionBD->prepare("SELECT foto FROM tbl_producto WHERE id=?");
                $sql->execute(array($id));
                $foto_antiguo=$sql->fetch();
                  
                    if(file_exists("vistas/images/producto/".$foto_antiguo['foto']))
                        { // si existe file
                            unlink("vistas/images/producto/".$foto_antiguo['foto']); //borra
                        }
                // INICIA eliminar registro
                $sql=$conexionBD->prepare("DELETE FROM tbl_producto WHERE id=?");
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


            public static function editar($id,$id_material,$id_categoria,$nombre,$descripcion,$medida,$p_ma,$peso,$nombre_foto)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("UPDATE tbl_producto SET id_material=?, id_categoria=?,nombre=?,descripcion=?, medida=?, p_ma=?, peso=?, foto=? WHERE id=?");

                $sql->execute(array($id_material,$id_categoria,ucwords($nombre),$descripcion,$medida,$p_ma,$peso,$nombre_foto,$id));
            } 

            public static function obtenerMateriales()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT id, nombre FROM tbl_material");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            public static function obtenerCategorias()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT id, nombre FROM tbl_categoria");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            public static function obtenerPorId($id)
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->prepare("SELECT p.*,m.nombre AS nom_material,c.nombre AS nom_categoria FROM tbl_producto as p
                                        LEFT JOIN (SELECT * FROM tbl_material) AS m
                                        ON p.id_material=m.id
                                        LEFT JOIN (SELECT * FROM tbl_categoria) AS c
                                        ON p.id_categoria=c.id
                                        WHERE p.id=?");
                $sql->execute([$id]);
                $data = $sql->fetch();
                
                return new Producto($data['id'],$data['id_material'],$data['id_categoria'],$data['nombre'],$data['descripcion'],$data['medida'],$data['p_ma'],$data['peso'],$data['foto'],$data['nom_material'],$data['nom_categoria']);
            }
        
}
?>