<?php
class ControlMaterial
{   
    public $id_resume;
public $id_detalle;
public $fecha;
    public $nombre;
    public $descripcion;
    public $cantidad;
    public $MATERIAL_ENTREGADO;
    public $MATERIAL_PRESTADO;
    public $MATERIAL_ESTADO;
    public $MANO_OBRA_COSTO;
    public $MANO_OBRA_PAGADO;

    public $MANO_OBRA_DEBE;
    public $MANO_OBRA_ESTADO;


    public function __construct($id_resume,$id_detalle,$fecha,$nombre,$descripcion,$cantidad,$MATERIAL_ENTREGADO,$MATERIAL_PRESTADO,$MATERIAL_ESTADO,$MANO_OBRA_COSTO,$MANO_OBRA_PAGADO,$MANO_OBRA_DEBE,$MANO_OBRA_ESTADO)
    { 
    $this->id_resume=$id_resume;
$this->id_detalle=$id_detalle;
$this->fecha=$fecha;
    $this->nombre=$nombre;
    $this->descripcion=$descripcion;
    $this->cantidad=$cantidad;
    $this->MATERIAL_ENTREGADO=$MATERIAL_ENTREGADO;
    $this->MATERIAL_PRESTADO=$MATERIAL_PRESTADO;
    $this->MATERIAL_ESTADO=$MATERIAL_ESTADO;
    $this->MANO_OBRA_COSTO=$MANO_OBRA_COSTO;
    $this->MANO_OBRA_PAGADO=$MANO_OBRA_PAGADO;
    $this->MANO_OBRA_DEBE=$MANO_OBRA_DEBE;
    $this->MANO_OBRA_ESTADO=$MANO_OBRA_ESTADO;
    }

    public static function consultar()
    {
        $listaControlMaterial = [];
        $conexionBD = BD::crearInstancia(); // Conexión a la base de datos
        
        // Consulta SQL para unir las tablas relacionadas tbl_material_resume
        $sql = $conexionBD->query("
            SELECT F2.id_resume,F2.id_detalle,F2.fecha, F1.nombre,F1.descripcion,F1.cantidad,
                F2.MATERIAL_ENTREGADO,F2.MATERIAL_PRESTADO,F2.MATERIAL_ESTADO,F2.MANO_OBRA_COSTO,
                F2.MANO_OBRA_PAGADO,F2.MANO_OBRA_DEBE,F2.MANO_OBRA_ESTADO
                FROM tbl_material_resume AS F1
                LEFT JOIN
                (
                SELECT A1.id_resume,A1.id_detalle,A1.fecha,A1.MATERIAL_ENTREGADO,A1.MATERIAL_PRESTADO,A1.MATERIAL_ESTADO,
                A2.MANO_OBRA_COSTO,A2.MANO_OBRA_PAGADO,A2.MANO_OBRA_DEBE,A2.MANO_OBRA_ESTADO
                FROM
                (  
                SELECT t1.id_resume,t1.id_detalle,t1.fecha,t1.MATERIAL_ENTREGADO,t2.MATERIAL_PRESTADO,t2.MATERIAL_ESTADO
                FROM 
                (
                SELECT t.id_resume,t.id_detalle,t.fecha,SUM(t.material_entregado) AS MATERIAL_ENTREGADO
                FROM (
                SELECT id_resume,id AS id_detalle,MAX(fecha) AS fecha,SUM(material_entregado) AS material_entregado
                FROM tbl_material_detalle
                GROUP BY id_resume
                UNION ALL
                SELECT id_resume,id AS id_detalle,MAX(fecha) AS fecha,SUM(material_prestado) AS material_entregado
                FROM tbl_material_detalle
                GROUP BY id_resume
                ) AS t
                GROUP BY t.id_resume
                ) AS t1
                LEFT JOIN
                (
                SELECT id_resume,SUM(material_prestado) AS MATERIAL_PRESTADO, IF(SUM(material_prestado)=0,'A FAVOR', 'DEBE') as MATERIAL_ESTADO FROM tbl_material_detalle
                GROUP BY id_resume
                )AS t2
                ON t1.id_resume = t2.id_resume   
                ) AS A1
                    
                LEFT JOIN
                (
                SELECT id_resume, SUM(costo_mo) as MANO_OBRA_COSTO, SUM(pagado_mo) as MANO_OBRA_PAGADO,
                SUM(costo_mo)-SUM(pagado_mo) as MANO_OBRA_DEBE,IF(SUM(pagado_mo)=SUM(costo_mo),'CANCELADO', 'DEBE') AS MANO_OBRA_ESTADO
                FROM tbl_material_detalle
                GROUP BY id_resume
                ) AS A2
                ON A1.id_resume = A2.id_resume
                ) AS F2
                ON F1.id = F2.id_resume LIMIT 5;
        ");

        foreach ($sql->fetchAll() as $Material_Resumen) {
            $listaControlMaterial[] = new ControlMaterial(
                $Material_Resumen['id_resume'],
                $Material_Resumen['id_detalle'],
                $Material_Resumen['fecha'],
                $Material_Resumen['nombre'],
                $Material_Resumen['descripcion'],
                $Material_Resumen['cantidad'],
                $Material_Resumen['MATERIAL_ENTREGADO'],
                $Material_Resumen['MATERIAL_PRESTADO'],
                $Material_Resumen['MATERIAL_ESTADO'],
                $Material_Resumen['MANO_OBRA_COSTO'],
                $Material_Resumen['MANO_OBRA_PAGADO'],
                $Material_Resumen['MANO_OBRA_DEBE'],
                $Material_Resumen['MANO_OBRA_ESTADO'],
            );
        }

        return $listaControlMaterial;
    }


    public static function consultar_resumen($id)
    {
        $conexionBD = BD::crearInstancia(); // Conexión a la base de datos
        // Consulta SQL para unir las tablas relacionadas tbl_material_resume
        $sql = $conexionBD->prepare("
                SELECT F2.id_resume,F2.id_detalle,F2.fecha, F1.nombre,F1.descripcion,F1.cantidad,
                F2.MATERIAL_ENTREGADO,F2.MATERIAL_PRESTADO,F2.MATERIAL_ESTADO,F2.MANO_OBRA_COSTO,
                F2.MANO_OBRA_PAGADO,F2.MANO_OBRA_DEBE,F2.MANO_OBRA_ESTADO
                FROM tbl_material_resume AS F1
                LEFT JOIN
                (
                SELECT A1.id_resume,A1.id_detalle,A1.fecha,A1.MATERIAL_ENTREGADO,A1.MATERIAL_PRESTADO,A1.MATERIAL_ESTADO,
                A2.MANO_OBRA_COSTO,A2.MANO_OBRA_PAGADO,A2.MANO_OBRA_DEBE,A2.MANO_OBRA_ESTADO
                FROM
                (  
                SELECT t1.id_resume,t1.id_detalle,t1.fecha,t1.MATERIAL_ENTREGADO,t2.MATERIAL_PRESTADO,t2.MATERIAL_ESTADO
                FROM 
                (
                SELECT t.id_resume,t.id_detalle,t.fecha,SUM(t.material_entregado) AS MATERIAL_ENTREGADO
                FROM (
                SELECT id_resume,id AS id_detalle,MAX(fecha) AS fecha,SUM(material_entregado) AS material_entregado
                FROM tbl_material_detalle
                GROUP BY id_resume
                UNION ALL
                SELECT id_resume,id AS id_detalle,MAX(fecha) AS fecha,SUM(material_prestado) AS material_entregado
                FROM tbl_material_detalle
                GROUP BY id_resume
                ) AS t
                GROUP BY t.id_resume
                ) AS t1
                LEFT JOIN
                (
                SELECT id_resume,SUM(material_prestado) AS MATERIAL_PRESTADO, IF(SUM(material_prestado)=0,'A FAVOR', 'DEBE') as MATERIAL_ESTADO FROM tbl_material_detalle
                GROUP BY id_resume
                )AS t2
                ON t1.id_resume = t2.id_resume   
                ) AS A1
                    
                LEFT JOIN
                (
                SELECT id_resume, SUM(costo_mo) as MANO_OBRA_COSTO, SUM(pagado_mo) as MANO_OBRA_PAGADO,
                SUM(costo_mo)-SUM(pagado_mo) as MANO_OBRA_DEBE,IF(SUM(pagado_mo)=SUM(costo_mo),'CANCELADO', 'DEBE') AS MANO_OBRA_ESTADO
                FROM tbl_material_detalle
                GROUP BY id_resume
                ) AS A2
                ON A1.id_resume = A2.id_resume
                ) AS F2
                ON F1.id = F2.id_resume
                WHERE F2.id_resume= ?
        ");
        $sql->execute([$id]);
        $data = $sql->fetchAll(PDO::FETCH_OBJ);
        
        return $data;
    }


    public static function obtenerPorId($id)
    {   
        $listaControlMaterial = [];
        $conexionBD = BD::crearInstancia();
        $sql = $conexionBD->prepare("
            SELECT z1.id_resume,z1.id_detalle,z1.fecha,z2.nombre,z2.descripcion,z2.cantidad,
            z1.MATERIAL_ENTREGADO,z1.MATERIAL_PRESTADO,z1.MATERIAL_ESTADO,z1.MANO_OBRA_COSTO,z1.MANO_OBRA_PAGADO,
            z1.MANO_OBRA_DEBE,z1.MANO_OBRA_ESTADO
            FROM
            (
            SELECT f1.id AS id_detalle,f1.id_resume,f1.fecha,f1.MATERIAL_ENTREGADO,f1.MATERIAL_PRESTADO,
            f1.MATERIAL_ESTADO,f1.MANO_OBRA_COSTO,f1.MANO_OBRA_PAGADO,f2.MANO_OBRA_DEBE,f2.MANO_OBRA_ESTADO
            FROM
            (
            SELECT id,id_resume,fecha,material_entregado AS MATERIAL_ENTREGADO,material_prestado AS MATERIAL_PRESTADO,
            IF(material_prestado=0,'A FAVOR', 'DEBE') as MATERIAL_ESTADO,costo_mo AS MANO_OBRA_COSTO,pagado_mo AS MANO_OBRA_PAGADO
            FROM tbl_material_detalle
            ) AS f1
            LEFT JOIN
            (
            SELECT id_resume,SUM(costo_mo)-SUM(pagado_mo) as MANO_OBRA_DEBE,IF(SUM(pagado_mo)=SUM(costo_mo),'CANCELADO', 'DEBE') AS MANO_OBRA_ESTADO
            FROM tbl_material_detalle
            GROUP BY id_resume
            ) AS f2
            ON f1.id_resume = f2.id_resume
            ) AS z1
            LEFT JOIN
            (
            SELECT id,nombre,descripcion,cantidad FROM tbl_material_resume
            ) AS z2
            ON z1.id_resume = z2.id WHERE z1.id_resume = ?
        ");
        $sql->execute([$id]);

        foreach ($sql->fetchAll() as $Material_Detalle) {
            $listaControlMaterial[] = new ControlMaterial(
                $Material_Detalle['id_resume'],
                $Material_Detalle['id_detalle'],
                $Material_Detalle['fecha'],
                $Material_Detalle['nombre'],
                $Material_Detalle['descripcion'],
                $Material_Detalle['cantidad'],
                $Material_Detalle['MATERIAL_ENTREGADO'],
                $Material_Detalle['MATERIAL_PRESTADO'],
                $Material_Detalle['MATERIAL_ESTADO'],
                $Material_Detalle['MANO_OBRA_COSTO'],
                $Material_Detalle['MANO_OBRA_PAGADO'],
                $Material_Detalle['MANO_OBRA_DEBE'],
                $Material_Detalle['MANO_OBRA_ESTADO'],
            );
        }

        return $listaControlMaterial;
        
        
    }



    public static function crear($id_tienda, $id_producto, $cantidad, $precio_unitario)
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
                INSERT INTO tbl_tienda_producto(id_tienda, id_producto, cantidad, precio_unitario, fecha)
                VALUES (?, ?, ?, ?, ?)
            ");
            $sql->execute([$id_tienda, $id_producto, $cantidad, $precio_unitario, $fecha]);
        }
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
}
?>

