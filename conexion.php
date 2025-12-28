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
                
                // URL completa que te genera Railway
                $url = "mysql://root:bcdzusIFRAKuoMknxcMBemJfRNRvAcyl@crossover.proxy.rlwy.net:40221/railway";
                
                $parsed = parse_url($url);
                
                $host = $parsed['host'];
                $port = $parsed['port'];
                $user = $parsed['user'];
                $pass = $parsed['pass'];
                $db = ltrim($parsed['path'], '/');
                
                $dsn = "mysql:host=$host;port=$port;dbname=$db";
                self::$instancia = new PDO($dsn, $user, $pass, $opcionesPDO);
                
            } catch (PDOException $e) {
                die("❌ Error BD: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>
