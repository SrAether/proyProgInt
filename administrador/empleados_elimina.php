<?php
// /administrador/empleados_elimina.php
require "../funciones/conecta.php";
// creamos la conexion a la base de datos
$con = conecta();

// obtenemos el id del empleado a eliminar
$id = $_REQUEST['id'];
// preparamos la consulta
$sql = "UPDATE empleados
        SET eliminado = 1
        WHERE id = $id";

// ejecutamos la consulta
$res = $con->query($sql);

// redireccionamos a la lista de empleados
header("Location: empleados_lista.php");

?>