<?php
// /administrador/empleados_salva.php
require "../funciones/conecta.php";
// creamos la conexion a la base de datos
$con = conecta();
// recuperamos los datos del formulario
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$nombre_imagen = $_FILES['archivo']['name']; // Nombre real de la imagen
$imagen_temp = $_FILES['archivo']['tmp_name']; // Nombre temporal de la imagen
$arreglo = explode(".", $nombre_imagen); // Separamos el nombre de la imagen de la extensión
$len = count($arreglo); // Contamos cuántos elementos tiene el arreglo
$pos = $len - 1; // La posición del último elemento
$ext = $arreglo[$pos]; // La extensión de la imagen
$dir = "../archivos/"; // Directorio donde se guardarán las imágenes
$nombre_imagen_enc = md5_file($imagen_temp); // Nombre encriptado de la imagen
if ($nombre_imagen != "")
{
    $nombre_imagen_enc = "$nombre_imagen_enc.$ext"; // Nombre de la imagen encriptado con la extensión
    copy($imagen_temp, $dir.$nombre_imagen_enc); // Copiamos la imagen al directorio
}
// ciframos la contraseña con md5
$pass = md5($pass);
// esto aun no tiene contenido 
$archivo_n = "";
$archivo_f = "";


// preparamos la consulta teniendo en cuenta la imagen
$sql = "INSERT INTO empleados
        (nombre, apellido, correo, pass, rol, archivo_n, archivo_f)
        VALUES
        ('$nombre', '$apellido', '$correo', '$pass', $rol, '$nombre_imagen', '$nombre_imagen_enc')";

// ejecutamos la consulta
$res = $con->query($sql);
// redireccionamos a la lista de empleados
header("Location: empleados_lista.php");

?>