<?php
require_once("modelos/usuario.php");
require_once("conexion.php");

class ControladorLogin
{

    public function login()
    {  
        if ($_POST) { 
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];

            $usuario = Usuario::autenticar($usuario, $clave);

            if ($usuario) {
                //session_start();
                $_SESSION['usuario'] = $usuario->id;
                $_SESSION['nom_cargo'] = $usuario->nom_cargo;
                $_SESSION['id_cargo'] = $usuario->id_cargo;
                $_SESSION['id_tienda'] = $usuario->id_tienda;
               header("Location: ?controlador=tiendaventas&&accion=index"); // Redirigir a la página principal
               exit();
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
        }
         include_once("vistas/login.php");
    }
 
    public function logout()
    {
        if(isset($_SESSION['usuario']))
        {
         //session_start();
        session_destroy();
        header("location:?controlador=login&accion=login");
        //echo "<script>location.href='./?controlador=login&accion=login'</script>";
        }
    }
}
?>

