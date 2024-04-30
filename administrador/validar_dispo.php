<?php
// ! Esta función toma un parámetro como puede ser el correo y verifica si ya existe en la base de datos, si existe regresa true, si no existe regresa false
// ? 1. Conectamos a la base de datos
require "../funciones/conecta.php";
$con = conecta();

// ? 2. Recibimos el parámetro que puede ser el correo o cualquier otro campo que queramos validar
$correo = $con->real_escape_string($_REQUEST['correo']);
// obtenemos el id del empleado 
$id = $con->real_escape_string($_REQUEST['id']);

// si el id es diferente de 0 entonces es una edicion


// ? 3. Hacemos la consulta para verificar si el correo ya existe y si no ha sido eliminado
$sql = "SELECT * FROM empleados WHERE correo = '$correo' AND eliminado = 0";
$res = $con->query($sql);

// si el id es diferente de 0 entonces es una edicion asi que verificamos que si hay un registro con el correo y que no sea el mismo id
if ($id != 0) {
    // extraemos el id del empleado de res
    $empleado = $res->fetch_assoc();
    $id_empleado = $empleado['id'];
    // si el id del empleado es diferente del id que estamos editando entonces el correo ya existe
    if ($id_empleado == $id) {
        echo "false";
        return;
    }
}



// ? 4. Si el número de registros es mayor a 0, entonces el correo ya existe
if ($res && $res->num_rows > 0) {
    echo "true";
} else {
    echo "false";
}
?>
