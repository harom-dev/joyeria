<?php
class BD{
        private static $instancia=NULL; // variable de conexion para usar en el modelo

        public static function crearInstancia(){
            if(!isset(self::$instancia)){ //entra si no hay conexion
            $opcionesPDO[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;

            self::$instancia = new PDO('mysql:host=localhost;dbname=db_joyeria','root','',$opcionesPDO);
                                        }
        return self::$instancia;
                                                }
        }

?>