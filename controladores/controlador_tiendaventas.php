<?php
require_once("modelos/distribucion.php");
require_once("modelos/tienda.php");
require_once("modelos/categoria.php");
require_once("conexion.php");
class ControladorTiendaVentas{


    /**
     * Método para mostra la tienda
     */

     public function index(){

         $productos = Distribucion::consultar();

         $tiendas = Tienda::consultar();

         $categorias = Categoria::consultar();
          
         include 'vistas/tiendaventas/index.php';
     }

     /**
      * Ver detalle del producto
      */

      public function detalle(){
        
        if(isset($_GET["prod"])){
            $producto = Distribucion::productoPorId($_GET["prod"]);
 
            include 'vistas/tiendaventas/detalle.php';
        }else{
            echo "<script>location.href='index.php?controlador=tiendaventas&accion=index'</script>";
        }
      }

      /**
       * agregar producto al carrito
       */
      public function addCart()
      {
 
           /// obtener al producto seleccionado
          $producto = Distribucion::productoPorId($_POST["id"]);

          $StockProducto = $producto[0]->cantidad;

          if(!isset($_SESSION["cart"]))
          {
            $_SESSION["cart"] = [];
          }

          /// validar si ese producto seleccionado ya existe en el carrito de compras

          if(!array_key_exists($_POST["id"],$_SESSION["cart"]))
          {
            /// agregamos al carrito de compras
           if($_SESSION["cart"][$_POST["id"]]["cantidad"] > $StockProducto){
            $_SESSION["error_stock"] = "Error, stock insuficiente!";
           }else{
            $_SESSION["cart"][$_POST["id"]]["producto"] = $producto[0]->nombre_producto;
            $_SESSION["cart"][$_POST["id"]]["foto"] = $producto[0]->foto;
            $_SESSION["cart"][$_POST["id"]]["precio"] = $producto[0]->precio_unitario;
            $_SESSION["cart"][$_POST["id"]]["cantidad"] = 1;
            $_SESSION["cart"][$_POST["id"]]["tienda"] = $producto[0]->nombre_tienda;
            $_SESSION["success"] = "producto añadido correctamente!";
           }
          }else{
             //$_SESSION["cart"][$_POST["id"]]["cantidad"] += 1;
            if($_SESSION["cart"][$_POST["id"]]["cantidad"] >= $StockProducto){
              $_SESSION["error_stock"] = "Error, stock insuficiente!";
              //$_SESSION["cart"][$_POST["id"]]["cantidad"] -= 1;
             }else{
              $_SESSION["cart"][$_POST["id"]]["cantidad"] += 1;
              $_SESSION["success"] = "producto añadido correctamente!";
             }
          }
          if(isset($_POST["comprar_index"])){
            header("location:./index.php?controlador=tiendaventas&&accion=index");
          }else{
            header("location:./index.php?controlador=tiendaventas&&accion=detalle&&prod=".$producto[0]->id);
          }

      }


      /**
       * Mostrar los productos añadidos al carrito
       */

       public function listacarrito()
       {
          if(isset($_SESSION["cart"])){
            $productoscarrito = $_SESSION["cart"] ;
          }

          include 'vistas/tiendaventas/listacarrito.php';
          
       }


       /***
        * Vaciar carrito
        */
        public function limpiarcarrito()
        {
            if(isset($_SESSION["cart"])){
               unset($_SESSION["cart"]);
               header("location:./index.php?controlador=tiendaventas&&accion=listacarrito");
            }
    
        }

        /**
         * Quitar producto de la lista del carrito
         */

        public function quitarproducto(){
            if(isset($_SESSION["cart"][$_POST["id"]])){
                unset($_SESSION["cart"][$_POST["id"]]);

                echo json_encode(["response" => "eliminado"]);
            }    
        }

        /**
         * Retornar los productos en json
         */
        public function showProductosTienda()
        {
           
             $productos = Distribucion::consultar();

             echo json_encode(["productos"=>$productos]);
           
        }


}