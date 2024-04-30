<?php
// empleados_lista.php
require "../funciones/conecta.php";
// ? 1. Conectamos a la base de datos
$con = conecta();
// ? 2. Preparamos la consulta
$sql = "SELECT * FROM empleados
        WHERE status = 1 AND eliminado = 0";
// ? 3. Ejecutamos la consulta
$res = $con->query($sql);
// ? 4. Contamos cuántos registros nos regresó
$num = $res->num_rows;

// especificamos que el contenido es HTML
header("Content-Type: text/html;charset=utf-8");
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Lista de empleados</title>";
echo "<link rel='stylesheet' href='../estilos/estilo.css'>";
// incluimos jquery
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>";
// area de javascript
echo "<script>";
// funcion para eliminar un empleado por medio de AJAX sin recargar la pagina y sin confirmacion
echo "function eliminar(id) {";
echo "  $.ajax({";
echo "    url: 'empleados_elimina.php',";
echo "    type: 'post',";
echo "    data: {";
echo "      id: id";
echo "    },";
echo "    success: function(data) {"; // si todo sale bien

echo "      $('#'+id).remove();"; // eliminamos el div con el id del empleado
// explicacion de la linea anterior: al usar $('#'+id) estamos seleccionando el div con el id del empleado y con .remove() lo eliminamos
echo "    }";
echo "  });";

echo "}"; // fin de la funcion eliminar 
echo "</script>"; // fin de javascript
echo "</head>";
echo "<body>";

//echo "Listado de empleados ($num) <br><br>";

echo "<div class='contenedor'>"; // contenedor de la tabla de divs

// Titulo
echo "<div class='Titulo'>Listado de empleados ($num)</div>";

// primera fila de la tabla
echo "<div class='fila'>";

// Columnas
echo "<div class='columnaID'>ID</div>";
//echo "<div class='columna'>Nombre</div>";
//echo "<div class='columna'>Apellido</div>";
// nombre y apellido se pueden mostrar juntos en una sola columna
echo "<div class='columna'>Nombre Completo</div>";
echo "<div class='columna'>Rol</div>";
echo "<div class='columna'>Correo</div>";
echo "<div class='columna'>Ver detalle</div>";
echo "<div class='columna'>Editar</div>";
echo "<div class='columna'>Eliminar</div>";

// fin de la primera fila
echo "</div>";

// ? 5. Mostramos los registros
while ($row = $res->fetch_array()) {
    $id = $row["id"];
    $nombre = $row["nombre"];
    $apellido = $row["apellido"];
    $rol = $row["rol"];
    $correo = $row["correo"];
    //echo "$id $nombre $apellido $correo <br>";
    // fila de la tabla, cada empleado es una fila y tiene como id el id del empleado
    //echo "<div class='fila'>";
    echo "<div class='fila' id='$id'>";
    echo "<div class='columnaID'>$id</div>";
    //echo "<div class='columna'>$nombre</div>";
    //echo "<div class='columna'>$apellido</div>";
    echo "<div class='columna'>$nombre $apellido</div>";
    //echo "<div class='columna'>$rol</div>";
    // en roles 1 es gereente y 2 es ejecutivo, cualquier otro valor es desconocido
    if ($rol == 1) {
        echo "<div class='columna'>Gerente</div>";
    } else if ($rol == 2) {
        echo "<div class='columna'>Ejecutivo</div>";
    } else {
        echo "<div class='columna'>Desconocido</div>";
    }
    echo "<div class='columna'>$correo</div>";
    echo "<div class='columna'>";
    //echo "<a href='empleados_ver_detalle.php?id=$id'>Ver detalle</a>";
    echo "<button class='botoon' onclick='location.href=\"empleados_ver_detalle.php?id=$id\"'>Ver detalle</button>";
    echo "</div>";
    //echo "<div class='columna'>Editar</div>";
    echo "<div class='columna'>";
    //echo "<a href='empleados_edita.php?id=$id'>Editar</a>";
    echo "<button class='botoon' onclick='location.href=\"empleados_edita.php?id=$id\"'>Editar</button>";
    echo "</div>";
    echo "<div class='columna'>";
    //echo "<a href='empleados_elimina.php?id=$id'>Eliminar</a>";
    // ahora vamos a eliminar por medio de AJAX sin recargar la pagina
    //echo "<button class='botoon' onclick='eliminar($id)'>Eliminar</button>";
    // eliminamos con confirmacion
    echo "<button class='botoon' onclick='if (confirm(\"¿Estás seguro de eliminar a $nombre $apellido?\")) { eliminar($id); }'>Eliminar</button>";
    echo "</div>";
    echo "</div>";
    
}

echo "</div>"; // fin del contenedor de la tabla de divs
// boton de nuevo empleado que te redirige a la pagina de empleados_alta.php
// echo "<div class='boton'>";
// echo "<a href='empleados_alta.php'>Nuevo empleado</a>";
// echo "</div>";
echo "<button class='boton' onclick='location.href=\"empleados_alta.php\"'>Nuevo empleado</button>";
echo "</body>";
echo "</html>";
?> 




