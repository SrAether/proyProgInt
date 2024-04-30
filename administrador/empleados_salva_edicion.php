<?php
// /administrador/empleados_salva_edicion.php
require "../funciones/conecta.php";
// creamos la conexion a la base de datos
$con = conecta();
// recuperamos los datos del formulario
$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$correo = $_REQUEST['correo'];
// n
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$nombre_imagen = $_FILES['archivo']['name']; // Nombre real de la imagen
$imagen_temp = $_FILES['archivo']['tmp_name']; // Nombre temporal de la imagen
$arreglo = explode(".", $nombre_imagen); // Separamos el nombre de la imagen de la extensión
$len = count($arreglo); // Contamos cuántos elementos tiene el arreglo
$pos = $len - 1; // La posición del último elemento
$ext = $arreglo[$pos]; // La extensión de la imagen
$dir = "../archivos/"; // Directorio donde se guardarán las imágenes

$nombre_imagen_enc = "";
if ($nombre_imagen != "")
{
    $nombre_imagen_enc = md5_file($imagen_temp); // Nombre encriptado de la imagen
}

// esto aun no tiene contenido 
$archivo_n = "";
$archivo_f = "";
echo "verificamos si se subió una imagen";
if ($nombre_imagen != "") // Si se subió una imagen
{
    echo "Se actualiza la imagen";
    $nombre_imagen_enc = "$nombre_imagen_enc.$ext"; // Nombre de la imagen encriptado con la extensión
    copy($imagen_temp, $dir.$nombre_imagen_enc); // Copiamos la imagen al directorio
    // actualizamos el nombre de la imagen archivo_n y archivo_f
    $archivo_n = $nombre_imagen;
    $archivo_f = $nombre_imagen_enc;
}
echo "verificamos si se actualiza la contraseña";
// consulta sql vacia
$sql = "";
// verificamos si la contraseña esta vacia si esta vacia no la actualizamos
if ($pass != "")
{
    echo "Se actualiza la contraseña";
    // ciframos la contraseña con md5
    $pass = md5($pass);
    // preparamos la consulta
    $sql = "UPDATE empleados
    SET nombre = '$nombre',
        apellido = '$apellido',
        correo = '$correo',
        pass = '$pass',
        rol = $rol";
    // --     archivo_n = '$archivo_n',
    // --     archivo_f = '$archivo_f'
    // -- WHERE id = $id";
} else {
    echo "No se actualiza la contraseña";
    // preparamos la consulta
    $sql = "UPDATE empleados
    SET nombre = '$nombre',
        apellido = '$apellido',
        correo = '$correo',
        rol = $rol";
    //     archivo_n = '$archivo_n',
    //     archivo_f = '$archivo_f'
    // WHERE id = $id";
}

// si se subió una imagen actualizamos los campos archivo_n y archivo_f
if ($nombre_imagen != "")
{
    $sql .= ", archivo_n = '$archivo_n',
    archivo_f = '$archivo_f'";
}
// completamos la consulta
$sql .= " WHERE id = $id";

// ejecutamos la consulta
$res = $con->query($sql);
// redireccionamos a la lista de empleados
header("Location: empleados_lista.php");

?>