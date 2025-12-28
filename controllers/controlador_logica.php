<?php 
require_once("../modelos/distribucion.php");
require_once("../conexion.php");

if(isset($_GET["controlador"]) && isset($_GET["accion"]))
{
    if($_GET["controlador"] === 'tiendaventas'){
        switch($_GET["accion"]){
            case "mostrarproductos":

                $IdData = $_REQUEST["dataid"];
                $opc = $_REQUEST["opc"];
                if($opc === "tienda"){
                    $productos = Distribucion::obtenerPorId($IdData);
                }else{
                 $productos = Distribucion::obtenerPorCategoria($IdData);
                }

                echo json_encode(["productos"=>$productos]);
            break;  
            
            case "buscar":
                $productos = Distribucion::searchProducto($_REQUEST["buscar"]);
                http_response_code(200);
                echo json_encode(["productos"=>$productos]);
            break;    
        } 
    }
}