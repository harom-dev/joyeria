<?php
class Tienda{

    public $id;
    public $nombre;
    public $direccion;
    public $departamento;
    public $id_provincia;
    public $id_distrito;
    public $nom_provincia;
    public $nom_distrito;
    public $logo;

    public function __construct($id, $nombre, $direccion, $departamento, $id_provincia, $id_distrito,$nom_provincia,$nom_distrito,$logo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->departamento = $departamento;
        $this->id_provincia = $id_provincia;
        $this->id_distrito = $id_distrito;
        $this->nom_provincia = $nom_provincia;
        $this->nom_distrito = $nom_distrito;
        $this->logo = $logo;
        
    }
        
    
        public static function consultar()
        {   
            $listaTiendas=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->query("SELECT g.id,g.nombre,g.direccion,g.departamento,g.provincia as id_provincia,g.distrito as id_distrito,g.nom_provincia,c.nombre as nom_distrito,g.logo
                                     from ( SELECT u.*,t.nombre as nom_provincia FROM tbl_tienda AS u LEFT JOIN tbl_provincia AS t ON u.provincia = t.id ) AS g
                                      LEFT JOIN tbl_distrito AS c ON g.distrito = c.id");

            foreach ($sql->fetchall() as $tienda){
                $listaTiendas[]= new Tienda($tienda['id'],$tienda['nombre'],$tienda['direccion'],$tienda['departamento'],$tienda['id_provincia'],$tienda['id_distrito'],$tienda['nom_provincia'],$tienda['nom_distrito'],$tienda['logo']); // se mete a la lista
            }
            return $listaTiendas;
        }

        public static function consultarXid($id_tienda)
        {   
            $listaTiendas=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->prepare("SELECT g.id,g.nombre,g.direccion,g.departamento,g.provincia AS id_provincia,g.distrito AS id_distrito,g.nom_provincia,c.nombre as nom_distrito,g.logo
                                     from (
                                        SELECT u.*,t.nombre as nom_provincia FROM tbl_tienda AS u
                                        LEFT JOIN tbl_provincia AS t ON u.provincia = t.id ) AS g
                                        LEFT JOIN tbl_distrito AS c ON g.distrito = c.id WHERE g.id=?"
                                        );
            $sql->execute([$id_tienda]);
            foreach ($sql->fetchall() as $tienda){
                $listaTiendas[]= new Tienda($tienda['id'],$tienda['nombre'],$tienda['direccion'],$tienda['departamento'],$tienda['id_provincia'],$tienda['id_distrito'],$tienda['nom_provincia'],$tienda['nom_distrito'],$tienda['logo']); // se mete a la lista
            }
            return $listaTiendas;
        }
           
        public static function crear($nombre,$direccion,$departamento,$provincia,$distrito,$nombre_logo)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("INSERT INTO tbl_tienda(nombre,direccion,departamento,provincia,distrito,logo) VALUES (?,?,?,?,?,?)");
                $sql->execute(array(strtoupper($nombre), strtoupper($direccion),$departamento,$provincia, $distrito,$nombre_logo));
            }

            public static function borrar($id)
            {

                $conexionBD=BD::crearInstancia($id);

                $sql=$conexionBD->prepare("DELETE FROM tbl_tienda WHERE id=?");
                $sql->execute(array($id));
            }


            public static function buscar($id)
            {
                $conexionBD=BD::crearInstancia(); //conexion a la base
                $sql=$conexionBD->prepare("SELECT g.id,g.nombre,g.direccion,g.departamento,g.provincia as id_provincia,g.distrito as id_distrito,g.nom_provincia,c.nombre as nom_distrito,g.logo
                                         from ( SELECT u.*,t.nombre as nom_provincia FROM tbl_tienda AS u LEFT JOIN tbl_provincia AS t ON u.provincia = t.id ) AS g
                                          LEFT JOIN tbl_distrito AS c
                                           ON g.distrito = c.id WHERE g.id=?");
                $sql->execute(array($id));
              
                    $tienda= $sql->fetch();
                
                return new Tienda($tienda['id'],$tienda['nombre'],$tienda['direccion'],$tienda['departamento'],$tienda['id_provincia'],$tienda['id_distrito'],$tienda['nom_provincia'],$tienda['nom_distrito'],$tienda['logo']); //creando un objeto que contenga dato
            }


            public static function editar($id,$nombre, $direccion, $departamento, $provincia, $distrito,$nombre_logo)
            {

                $conexionBD=BD::crearInstancia();

                $sql=$conexionBD->prepare("UPDATE tbl_tienda SET nombre=?,direccion=?,departamento=?,provincia=?,distrito=?,logo=? WHERE id=?");
                $sql->execute(array(strtoupper($nombre),strtoupper($direccion), $departamento, $provincia, $distrito,$nombre_logo,$id));
            }

            public static function obtenerProvincia()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT * FROM tbl_provincia");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            
            public static function obtenerDistrito()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT * FROM tbl_distrito");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        
}
?>