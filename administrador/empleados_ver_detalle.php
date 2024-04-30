<?php
// /administrador/empleados_ver_detalle.php
require "../funciones/conecta.php";
// creamos la conexion a la base de datos
$con = conecta();

// obtenemos el id del empleado para ver todos los datos del empleado
$id = $_REQUEST['id'];
// preparamos la consulta
$sql = "SELECT * FROM empleados
        WHERE id = $id";

// ejecutamos la consulta
$res = $con->query($sql);

$empleado = $res->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detalle de empleado</title>
    <link rel='stylesheet' href='../estilos/estiloVerDetalle.css'>
</head>
<body>
    <div> 
        <!-- botones de navegacion -->
        <button onclick="window.location.href='empleados_lista.php'">Lista de empleados</button>
        <button onclick="window.location.href='empleados_alta.php'">Alta de empleados</button>
    </div>
    <!-- Nombre + Apellidos
Correo
Rol
Status (Activo e inactivo)-->
    <div class="contenedor">
        
        
       
        <h1>Detalle de empleado</h1>
        <!-- <div class="contenedorDatos">
            <div class="etiqueta">Nombre:</div>
            <div class="dato"><?php echo $empleado['nombre']; ?></div>
        </div>
        <div class="contenedorDatos">
            <div class="etiqueta">Apellido:</div>
            <div class="dato"><?php echo $empleado['apellido']; ?></div>
        </div> -->
        <!-- nombre y apellidos -->
        <div class="contenedorDatos">
            <div class="etiqueta">Nombre:</div>
            <div class="dato"><?php echo $empleado['nombre'] . " " . $empleado['apellido']; ?></div>
        </div>
        <div class="contenedorDatos">
            <div class="etiqueta">Correo:</div>
            <div class="dato"><?php echo $empleado['correo']; ?></div>
        </div>
        <div class="contenedorDatos">
            <div class="etiqueta">Rol:</div>
            <div class="dato">
                <?php
                if ($empleado['rol'] == 1) {
                    echo "Gerente";
                } else if ($empleado['rol'] == 2) {
                    echo "Ejecutivo";
                } else {
                    echo "Desconocido";
                }
                ?>
            </div>
        </div>
        <div class="contenedorDatos">
            <div class="etiqueta">Status:</div>
            <div class="dato">
                <?php
                if ($empleado['status'] == 1) {
                    echo "Activo";
                } else {
                    echo "Inactivo";
                }
                ?>
            </div>
        </div>
        <!-- imagen -->
        <div class="contenedorDatos">
            <div class="etiqueta">Imagen:</div>
            
            <br>
            <br>
            <div class="dato" >
                <img src="../archivos/<?php echo $empleado['archivo_f']; ?>" alt="Imagen del empleado" width="100%">
            </div>
        </div>
        
    </div>
</body>
</html>