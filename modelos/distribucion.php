<?php
class Distribucion
{
    public $id;
    public $nombre_tienda;
    public $nombre_producto;
    public $nombre_material;
    public $nombre_categoria;
    public $cantidad;
    public $precio_unitario;
    public $p_me;
    public $fecha;
    public $foto;
    public $id_tienda;
    public $id_producto;

    public function __construct($id, $nombre_tienda, $nombre_producto, $nombre_material, $nombre_categoria, $cantidad, $precio_unitario,$p_me, $fecha,$foto,
    $id_tienda,$id_producto)
    {
        $this->id = $id;
        $this->nombre_tienda = $nombre_tienda;
        $this->nombre_producto = $nombre_producto;
        $this->nombre_material = $nombre_material;
        $this->nombre_categoria = $nombre_categoria;
        $this->cantidad = $cantidad;
        $this->precio_unitario = $precio_unitario;
        $this->p_me = $p_me;
        $this->fecha = $fecha;
        $this->foto = $foto;
        $this->id_tienda=$id_tienda;
        $this->id_producto=$id_producto;
    }

    public static function consultar()
    {
        $listaDistribuciones = [];
        $conexionBD = BD::crearInstancia(); // Conexión a la base de datos
        
        // Consulta SQL para unir las tablas relacionadas
        $sql = $conexionBD->query("
            SELECT
                tp.id,
                t.nombre AS nombre_tienda,
                p.nombre AS nombre_producto,
                m.nombre AS nombre_material,
                c.nombre AS nombre_categoria,
                tp.cantidad,
                tp.precio_unitario,
                tp.p_me,
                tp.fecha,
                p.foto,
                tp.id_tienda,
                tp.id_producto
            FROM
                tbl_tienda_producto tp
            INNER JOIN
                tbl_tienda t ON tp.id_tienda = t.id
            INNER JOIN
                tbl_producto p ON tp.id_producto = p.id
            INNER JOIN
                tbl_material m ON p.id_material = m.id
            INNER JOIN
                tbl_categoria c ON p.id_categoria = c.id
        ");

        foreach ($sql->fetchAll() as $distribucion) {
            $listaDistribuciones[] = new Distribucion(
                $distribucion['id'],
                $distribucion['nombre_tienda'],
                $distribucion['nombre_producto'],
                $distribucion['nombre_material'],
                $distribucion['nombre_categoria'],
                $distribucion['cantidad'],
                $distribucion['precio_unitario'],
                $distribucion['p_me'],
                $distribucion['fecha'],
                $distribucion["foto"],
                $distribucion["id_tienda"],
                $distribucion["id_producto"]
            );
        }

        return $listaDistribuciones;
    }

    public static function consultarXtienda($id_tienda)
    {
        $listaDistribuciones = [];
        $conexionBD = BD::crearInstancia(); // Conexión a la base de datos
        
        // Consulta SQL para unir las tablas relacionadas
        $sql = $conexionBD->prepare("
            SELECT
                tp.id,
                t.nombre AS nombre_tienda,
                p.nombre AS nombre_producto,
                m.nombre AS nombre_material,
                c.nombre AS nombre_categoria,
                tp.cantidad,
                tp.precio_unitario,
                tp.p_me,
                tp.fecha,
                p.foto,
                tp.id_tienda,
                tp.id_producto
            FROM
                tbl_tienda_producto tp
            INNER JOIN
                tbl_tienda t ON tp.id_tienda = t.id
            INNER JOIN
                tbl_producto p ON tp.id_producto = p.id
            INNER JOIN
                tbl_material m ON p.id_material = m.id
            INNER JOIN
                tbl_categoria c ON p.id_categoria = c.id  WHERE t.id=?
        ");
        $sql->execute([$id_tienda]);
        foreach ($sql->fetchAll() as $distribucion) {
            $listaDistribuciones[] = new Distribucion(
                $distribucion['id'],
                $distribucion['nombre_tienda'],
                $distribucion['nombre_producto'],
                $distribucion['nombre_material'],
                $distribucion['nombre_categoria'],
                $distribucion['cantidad'],
                $distribucion['precio_unitario'],
                $distribucion['p_me'],
                $distribucion['fecha'],
                $distribucion["foto"],
                $distribucion["id_tienda"],
                $distribucion["id_producto"],
            );
        }

        return $listaDistribuciones;
    }

    public static function crear($id_tienda, $id_producto, $cantidad, $precio_unitario,$p_me)
    {
        $conexionBD = BD::crearInstancia();
        $fecha = date('Y-m-d');
        
        // Verificar si ya existe una distribución para la misma tienda y producto
        $sql = $conexionBD->prepare("
            SELECT id, cantidad
            FROM tbl_tienda_producto
            WHERE id_tienda = ? AND id_producto = ?
        ");
        $sql->execute([$id_tienda, $id_producto]);
        $resultado = $sql->fetch();

        if ($resultado) {
            // Actualizar la cantidad si ya existe un registro
            $nueva_cantidad = $resultado['cantidad'] + $cantidad;
            $id = $resultado['id'];
            $sql = $conexionBD->prepare("
                UPDATE tbl_tienda_producto
                SET cantidad = ?, precio_unitario = ?, fecha = ?
                WHERE id = ?
            ");
            $sql->execute([$nueva_cantidad, $precio_unitario, $fecha, $id]);
        } else {
            // Crear un nuevo registro si no existe
            $sql = $conexionBD->prepare("
                INSERT INTO tbl_tienda_producto(id_tienda, id_producto, cantidad, precio_unitario,p_me,fecha)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $sql->execute([$id_tienda, $id_producto, $cantidad, $precio_unitario,$p_me,$fecha]);
        }
    }

    

    public static function productoPorId($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("
            SELECT
                tp.id,
                tp.id_tienda,
                tp.id_producto,
                tp.cantidad,
                tp.precio_unitario,
                tp.p_me,
                tp.fecha,
                t.nombre AS nombre_tienda,
                p.nombre AS nombre_producto,
                m.nombre AS nombre_material,
                c.nombre AS nombre_categoria,
                p.foto
            FROM
                tbl_tienda_producto tp
            INNER JOIN
                tbl_tienda t ON tp.id_tienda = t.id
            INNER JOIN
                tbl_producto p ON tp.id_producto = p.id
            INNER JOIN
                tbl_material m ON p.id_material = m.id
            INNER JOIN
                tbl_categoria c ON p.id_categoria = c.id
                WHERE tp.id=?
        ");
        $sql->execute([$id]);
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        
        return $data;
    }

    

    public static function obtenerPorId($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("
            SELECT
                tp.id,
                tp.id_tienda,
                tp.id_producto,
                tp.cantidad,
                tp.precio_unitario,
                tp.fecha,
                t.nombre AS nombre_tienda,
                p.nombre AS nombre_producto,
                m.nombre AS nombre_material,
                c.nombre AS nombre_categoria,
                p.foto
            FROM
                tbl_tienda_producto tp
            INNER JOIN
                tbl_tienda t ON tp.id_tienda = t.id
            INNER JOIN
                tbl_producto p ON tp.id_producto = p.id
            INNER JOIN
                tbl_material m ON p.id_material = m.id
            INNER JOIN
                tbl_categoria c ON p.id_categoria = c.id
                WHERE tp.id_tienda=?
        ");
        $sql->execute([$id]);
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        
        return $data;
    }

    public static function obtenerPorCategoria($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("
            SELECT
                tp.id,
                tp.id_tienda,
                tp.id_producto,
                tp.cantidad,
                tp.precio_unitario,
                tp.fecha,
                t.nombre AS nombre_tienda,
                p.nombre AS nombre_producto,
                m.nombre AS nombre_material,
                c.nombre AS nombre_categoria,
                p.foto
            FROM
                tbl_tienda_producto tp
            INNER JOIN
                tbl_tienda t ON tp.id_tienda = t.id
            INNER JOIN
                tbl_producto p ON tp.id_producto = p.id
            INNER JOIN
                tbl_material m ON p.id_material = m.id
            INNER JOIN
                tbl_categoria c ON p.id_categoria = c.id
                WHERE p.id_categoria=?
        ");
        $sql->execute([$id]);
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        
        return $data;
    }

    public static function searchProducto($search)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("
            SELECT
                tp.id,
                tp.id_tienda,
                tp.id_producto,
                tp.cantidad,
                tp.precio_unitario,
                tp.fecha,
                t.nombre AS nombre_tienda,
                p.nombre AS nombre_producto,
                m.nombre AS nombre_material,
                c.nombre AS nombre_categoria,
                p.foto
            FROM
                tbl_tienda_producto tp
            INNER JOIN
                tbl_tienda t ON tp.id_tienda = t.id
            INNER JOIN
                tbl_producto p ON tp.id_producto = p.id
            INNER JOIN
                tbl_material m ON p.id_material = m.id
            INNER JOIN
                tbl_categoria c ON p.id_categoria = c.id
                WHERE  p.nombre like ?
        ");
         $sql->bindValue(1,'%'.$search.'%');
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        
        return $data;
    }

    public static function actualizar($id, $id_tienda, $id_producto, $cantidad, $precio_unitario, $fecha)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("
            UPDATE tbl_tienda_producto
            SET id_tienda = ?, id_producto = ?, cantidad = ?, precio_unitario = ?, fecha = ?
            WHERE id = ?
        ");
        $sql->execute([$id_tienda, $id_producto, $cantidad, $precio_unitario, $fecha, $id]);
    }

    public static function borrar($id)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("DELETE FROM tbl_tienda_producto WHERE id = ?");
        $sql->execute([$id]);
    }

    public static function obtenerTiendas()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->query("SELECT id, nombre FROM tbl_tienda");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTiendasXid($id_tienda)
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("SELECT id, nombre FROM tbl_tienda WHERE id = ?");
        $sql->execute([$id_tienda]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerProductos()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->query("
            SELECT p.id, p.nombre, m.nombre AS nombre_material, c.nombre AS nombre_categoria
            FROM tbl_producto p
            INNER JOIN tbl_material m ON p.id_material = m.id
            INNER JOIN tbl_categoria c ON p.id_categoria = c.id
            ORDER BY p.nombre ASC
        ");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function obtenerCategoriaPorMaterial($id_material) {
    try {
        // Asegúrate de que la conexión esté creada
        BD::crearInstancia();
        
        // Obtén la conexión
        $conexionBD = BD::crearInstancia();

        // Prepara la consulta
        $query = "select distinct tc.id as id_categoria,tc.nombre as categoria from tbl_material tm
        join tbl_producto tp on tm.id=tp.id_material
        left join tbl_categoria tc on tc.id=tp.id_categoria
        where tm.id = :id_material";

            // Prepara y ejecuta la consulta
        $stmt = $conexionBD->prepare($query);
        $stmt->bindParam(':id_material', $id_material, PDO::PARAM_INT); 
        $stmt->execute();

        // Retorna los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejo del error
        die("Error en la consulta: " . $e->getMessage());
    }
}

public static function obtenerMateriales()
    {
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->query("SELECT *FROM tbl_producto as p left join tbl_material as m on
         p.id_material=m.id");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


 public static function obtenerProductosPorCategoriaYMaterial($id_material, $id_categoria) {
    try {
        BD::crearInstancia();
        $conexionBD = BD::crearInstancia();

        $query = "SELECT id AS id_producto, nombre AS nombre_producto 
                  FROM tbl_producto 
                  WHERE id_material = :id_material AND id_categoria = :id_categoria";

        $stmt = $conexionBD->prepare($query);
        $stmt->bindParam(':id_material', $id_material, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}
   
    
}
?>

