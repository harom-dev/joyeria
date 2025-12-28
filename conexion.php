<?php
class BD{
    private static $instancia = NULL;
    
    public static function crearInstancia(){
        if(!isset(self::$instancia)){
            try {
                $opcionesPDO = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ];
                
                self::$instancia = new PDO(
                    "mysql:host=" . getenv("MYSQLHOST") .
                    ";port=" . getenv("MYSQLPORT") .
                    ";dbname=" . getenv("MYSQLDATABASE"),
                    getenv("MYSQLUSER"),
                    getenv("MYSQLPASSWORD"),
                    $opcionesPDO
                );
            } catch (PDOException $e) {
                die("❌ Error BD: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>
