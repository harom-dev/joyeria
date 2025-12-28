<?php
class BD{
    private static $instancia = NULL;
    
    public static function crearInstancia(){
        if(!isset(self::$instancia)){
            try {
                $url = getenv("MYSQL_URL");
                
                // Parsear la URL: mysql://user:password@host:port/database
                $parsed = parse_url($url);
                
                $host = $parsed['host'];
                $port = $parsed['port'] ?? 3306;
                $user = $parsed['user'];
                $pass = $parsed['pass'];
                $db = ltrim($parsed['path'], '/');
                
                $opcionesPDO = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ];
                
                $dsn = "mysql:host=" . $host . ";port=" . $port . ";dbname=" . $db;
                self::$instancia = new PDO($dsn, $user, $pass, $opcionesPDO);
                
            } catch (PDOException $e) {
                die("❌ Error BD: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>
