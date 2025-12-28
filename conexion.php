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
                    "mysql:host=sql304.infinityfree.com;port=3306;dbname=if0_40780596_XXX",
                    "if0_40780596",
                    "H4n5lnv3nt4r10",
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
