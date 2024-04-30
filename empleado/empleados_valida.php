<?php
// /administrador/empleados_salva.php
require "../funciones/conecta.php";
// creamos la conexion a la base de datos
$con = conecta();
// mostramos los datos que se enviaron por el formulario

// recuperamos los datos del formulario
$correo = $_POST['correo'];
$pass = $_REQUEST['pass'];

// ciframos la contraseña con md5
$pass = md5($pass);

// preparamos la consulta
$sql = "SELECT * FROM empleados
        WHERE correo = '$correo' AND pass = '$pass'";
// ejecutamos la consulta
$res = $con->query($sql);

// verificamos si se encontro un registro y si la contraseña es correcta o no
if ($res->num_rows == 0) {
    // si no se encontro el correo
    echo "no";
} else {
    // si se encontro el correo
    echo "correcto";
    
    
}

?>