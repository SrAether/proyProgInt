<?php
    $file_name = $_FILES['archivo']['name']; // Nombre real del archivo
    $file_tmp = $_FILES['archivo']['tmp_name']; // Nombre temporal del archivo
    $arreglo = explode(".", $file_name); // Separamos el nombre del archivo de la extensión
    $len = count($arreglo); // Contamos cuántos elementos tiene el arreglo
    $pos = $len - 1; // La posición del último elemento
    $ext = $arreglo[$pos]; // La extensión del archivo
    $dir = "../archivos/"; // Directorio donde se guardarán los archivos
    $file_enc = md5_file($file_tmp); // Nombre encriptado del archivo

    echo "Nombre real del archivo: $file_name<br>";
    echo "Nombre temporal del archivo: $file_tmp<br>";
    echo "Extensión del archivo: $ext<br>";
    echo "Nombre encriptado del archivo: $file_enc<br>";

    if ($file_name != "")
    {
        $fileName1 = "$file_enc.$ext"; // Nombre del archivo encriptado con la extensión
        copy($file_tmp, $dir.$fileName1); // Copiamos el archivo al directorio
        echo "Archivo guardado en: $dir$fileName1"; // Mostramos el mensaje de que el archivo se guardó que realmente es /
    }

?>
