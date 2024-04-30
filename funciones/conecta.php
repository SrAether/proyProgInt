<?php
// Funciones/conecta.php
define("HOST", "localhost");
define("BD", "d02");
define("USER_BD", "root");
define("PASS_BD", "SrAether@13&");
function conecta(){
    $conexion = new mysqli(HOST, USER_BD, PASS_BD, BD);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    return $conexion;
}
?>

