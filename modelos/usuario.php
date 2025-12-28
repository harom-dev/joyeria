<?php
class Usuario{

    public $id;
    public $nom_tienda;
    public $nombre;
    public $celular;
    public $correo;
    public $usuario;
    public $clave;
    public $nom_cargo;
    public $id_tienda;
    public $id_cargo;
    public $logo;


public function __construct($id,$nom_tienda,$nombre,$celular,$correo,$usuario,$clave,$nom_cargo,$id_tienda,$id_cargo,$logo)
{
    $this->id=$id;
    $this->nom_tienda=$nom_tienda;
    $this->nombre=$nombre;
    $this->celular=$celular;
    $this->correo=$correo;
    $this->usuario=$usuario;
    $this->clave=$clave;
    $this->nom_cargo=$nom_cargo;
    $this->id_tienda=$id_tienda;
    $this->id_cargo=$id_cargo;
    $this->logo=$logo;
}


        public static function consultar()
        {
            $listaUsuarios=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->query("SELECT g.id,g.nom_tienda,g.nombre,g.celular,g.correo,g.usuario,g.clave,c.nombre as nom_cargo,g.id_tienda,g.id_cargo,g.logo
                                    from (
                                            SELECT u.*,t.nombre as nom_tienda,t.logo FROM tbl_usuario AS u
                                            LEFT JOIN tbl_tienda AS t ON u.id_tienda = t.id ) AS g
                                    LEFT JOIN tbl_cargo AS c ON g.id_cargo = c.id");

            foreach ($sql->fetchall() as $usuario){
                $listaUsuarios[]= new Usuario($usuario['id'],$usuario['nom_tienda'],$usuario['nombre'],$usuario['celular'],$usuario['correo'],$usuario['usuario'],$usuario['clave'],$usuario['nom_cargo'],$usuario['id_tienda'],$usuario['id_cargo'],$usuario['logo']); // se mete a la lista
            }
            return $listaUsuarios;
        }

        public static function consultarXtienda($id_tienda)
        {
            $listaUsuarios=[]; //declarar variable
            $conexionBD=BD::crearInstancia(); //conexion a la base
            $sql=$conexionBD->prepare("SELECT g.*,c.nombre as nom_cargo from (
                                                    SELECT u.*,t.nombre as nom_tienda FROM tbl_usuario AS u
                                                    LEFT JOIN tbl_tienda AS t ON u.id_tienda = t.id ) AS g
                                    LEFT JOIN tbl_cargo AS c ON g.id_cargo = c.id WHERE g.id_tienda = ?");
            $sql->execute([$id_tienda]);

            foreach ($sql->fetchAll() as $usuario) {
                $listaUsuarios[] = new Usuario(
                    $usuario['id'], 
                    $usuario['nom_tienda'], 
                    $usuario['nombre'], 
                    $usuario['celular'], 
                    $usuario['correo'], 
                    $usuario['usuario'], 
                    $usuario['clave'], 
                    $usuario['nom_cargo'], 
                    $usuario['id_tienda'], 
                    $usuario['id_cargo']
                );
                
            }
            return $listaUsuarios;
        }
           
        public static function crear($id_tienda,$nombre,$celular,$usuario,$correo,$clave,$id_cargo)
            {

                $conexionBD=BD::crearInstancia();
                $contrasenaHasheada = password_hash($clave, PASSWORD_BCRYPT);

                $sql=$conexionBD->prepare("INSERT INTO tbl_usuario(id_tienda,nombre,celular,usuario,correo,clave,id_cargo) VALUES (?,?,?,?,?,?,?)");
                $sql->execute(array($id_tienda,$nombre,$celular,$usuario,$correo,$contrasenaHasheada,$id_cargo));
            }

            public static function borrar($id)
            {

                $conexionBD=BD::crearInstancia($id);

                $sql=$conexionBD->prepare("DELETE FROM tbl_usuario WHERE id=?");
                $sql->execute(array($id));
            }


            public static function buscar($id)
            {
                $conexionBD=BD::crearInstancia(); //conexion a la base
                $sql=$conexionBD->prepare("SELECT g.id,g.nom_tienda,g.nombre,g.celular,g.correo,g.usuario,g.clave,c.nombre as nom_cargo,g.id_tienda,c.id AS id_cargo,g.logo
                                            from (
                                                SELECT u.*,t.nombre as nom_tienda,t.logo FROM tbl_usuario AS u
                                                    LEFT JOIN tbl_tienda AS t
    												ON u.id_tienda = t.id ) AS g
                                                LEFT JOIN tbl_cargo AS c ON g.id_cargo = c.id WHERE g.id=?"
                                                );
                $sql->execute(array($id));
                $usuario= $sql->fetch();
                   // print_r($usuario);
                return new Usuario($usuario['id'],$usuario['nom_tienda'],$usuario['nombre'],$usuario['celular'],$usuario['correo'],$usuario['usuario'],$usuario['clave'],$usuario['nom_cargo'],$usuario['id_tienda'],$usuario['id_cargo'],$usuario['logo']); //creando un objeto que contenga dato
            }


            public static function editar($id,$id_tienda,$nombre,$celular,$usuario,$correo,$clave,$id_cargo)
            {

                $conexionBD=BD::crearInstancia();
                $contrasenaHasheada = password_hash($clave, PASSWORD_BCRYPT);

                $sql=$conexionBD->prepare("UPDATE tbl_usuario SET id_tienda=?,nombre=?,celular=?,usuario=?,correo=?,clave=?,id_cargo=? WHERE id=?");
                $sql->execute(array($id_tienda,$nombre,$celular,$usuario,$correo,$contrasenaHasheada,$id_cargo,$id));
            } 

            public static function obtenerTiendas()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT * FROM tbl_tienda");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            public static function obtenerTiendasXid($id_tienda)
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->prepare("SELECT * FROM tbl_tienda WHERE id = ?");
                $sql->execute([$id_tienda]);
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            public static function obtenerCargos()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT * FROM tbl_cargo");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            public static function obtenerCargosAdmin()
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->query("SELECT * FROM tbl_cargo WHERE id = 2");
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            public static function autenticar($usuario, $clave)
            {
                $conexionBD = BD::crearInstancia();
                $sql = $conexionBD->prepare("SELECT g.id,g.nom_tienda,g.nombre,g.celular,g.correo,g.usuario,g.clave,c.nombre as nom_cargo,g.id_tienda,g.id_cargo,g.logo
                                        from (
                                                    SELECT u.*,t.nombre as nom_tienda,t.logo FROM tbl_usuario AS u
                                                    LEFT JOIN tbl_tienda AS t ON u.id_tienda = t.id ) AS g
                                        LEFT JOIN tbl_cargo AS c ON g.id_cargo = c.id WHERE g.usuario =?");
                $sql->execute([$usuario]);

                if ($sql->rowCount() == 1) {
                $data = $sql->fetch();
                if (password_verify($clave, $data['clave']))
                    {
                    return new Usuario($data['id'],$data['nom_tienda'],$data['nombre'],$data['celular'],$data['correo'],$data['usuario'],$data['clave'],$data['nom_cargo'],$data['id_tienda'],$data['id_cargo'],$dat['logo']);
                    }
                }

                    return null;
            }
}
?>