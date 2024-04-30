<?php
// /administrador/empleados_edita.php
require "../funciones/conecta.php";
// creamos la conexion a la base de datos
$con = conecta();

// obtenemos el id del empleado para rellenar los campos
$id = $_REQUEST['id'];
// preparamos la consulta
$sql = "SELECT * FROM empleados
        WHERE id = $id";

// ejecutamos la consulta
$res = $con->query($sql);

// extraemos los datos del empleado
$empleado = $res->fetch_assoc();
$nombre = $empleado['nombre'];
$apellido = $empleado['apellido'];
$correo = $empleado['correo'];
$rol = $empleado['rol'];




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        Editar empleados
    </title>
    <!-- CSS con estilo cyberpunk para el formulario -->
    <link rel="stylesheet" href="../estilos/estiloCyberpunk.css">
    <!-- php para validar_dispo.php -->
    <script src="validar_dispo.php"></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   

</head>
<body>
    
    <div> 
        <!-- botones de navegacion -->
        <button onclick="window.location.href='empleados_lista.php'">Lista de empleados</button>
        <button onclick="window.location.href='empleados_alta.php'">Alta de empleados</button>
    
    </div>

    <!-- Formulario de alta de empleados -->
    <form id="formulario" name="formulario" action="empleados_salva_edicion.php" method="POST" onsubmit="return validar();" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $apellido; ?>">
        <label for="correo">
            Correo:
        </label>
        <div class="contCorreo">
            
            <input type="text" id="correo" name="correo" placeholder="Correo" onblur="verificarCorreo();" value="<?php echo $correo; ?>">
            <!-- mensaje de correo ya existente -->
            <div id="mensajeCorreo"></div>
        </div>

        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" placeholder="Coloca una nueva contraseña">

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" value="<?php echo $rol; ?>">
            <option value="0">Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select>
        <!-- actualizamos el valor del select con el rol del empleado -->
        <script>
            document.getElementById('rol').value = "<?php echo $rol; ?>";
        </script>
        <!-- damos un mensaje de que solo coloque una nueva contraseña si desea cambiarla -->
        <label for="imagen">Imagen nueva:</label>
        <input name="archivo" type="file" id = "archivo">
        <br>

        <button type="submit"> Finalizar edición
        </button> 
        <!-- div para mostrar mensaje de falta de datos -->
        <div id="mensajeFaltaDatos"></div>
        <!--<input type="submit" value="Enviar"> -->
    </form>
    <script>
        function validar() {
            var nombre = document.getElementById('nombre').value;
            var apellido = document.getElementById('apellido').value;
            var correo = document.getElementById('correo').value;
            var pass = document.getElementById('pass').value;
            var rol = document.getElementById('rol').value;
            var imagen = document.getElementById('archivo').value;
            if (nombre == "" || apellido == "" || correo == "" || rol == "0") {
                // mostramos un mensaje primero activamos el div
                document.getElementById('mensajeFaltaDatos').style.display = "block";
                document.getElementById('mensajeFaltaDatos').innerHTML = "Faltan datos por llenar";
                // lo mostramos solo 5 segundos
                setTimeout(function() {
                    document.getElementById('mensajeFaltaDatos').style.display = "none";
                    document.getElementById('mensajeFaltaDatos').innerHTML = "";
                }, 5000);
                return false;

            } // ahora lo comparamos con el contenido de las variables de la base de datos
            else if (nombre == "<?php echo $nombre; ?>" && apellido == "<?php echo $apellido; ?>" && correo == "<?php echo $correo; ?>" && rol == "<?php echo $rol; ?>" && pass == "" && imagen == "") {
                // mostramos un mensaje primero activamos el div
                document.getElementById('mensajeFaltaDatos').style.display = "block";
                document.getElementById('mensajeFaltaDatos').innerHTML = "No se han hecho cambios";
                // lo mostramos solo 5 segundos
                setTimeout(function() {
                    document.getElementById('mensajeFaltaDatos').style.display = "none";
                    document.getElementById('mensajeFaltaDatos').innerHTML = "";
                }, 5000);
                return false;
            } else {
                alert("El usuario se ha editado correctamente");
                return true;
                //document.getElementById('formulario').submit();
                //document.getElementById('formulario').action = "empleados_salva.php";

            }
        }
        // funcion para verificar si el correo ya existe y si ya existe borra el contenido del campo correo y muestra un mensaje
        function verificarCorreo() {
            var correo = document.getElementById('correo').value;
            // lo mostramos en consola
            console.log(correo);
            $.ajax({
                url: 'validar_dispo.php',
                type: 'post',
                data: {
                    correo: correo,
                    id: <?php echo $id; ?>
                },
                success: function(data) {
                    console.log(data); // Esto mostrará en la consola del navegador la respuesta del servidor

                    if (data.trim() === "true") { // Utiliza trim() para eliminar espacios en blanco
                        // El correo ya existe
                        //alert("El correo ya existe");
                        document.getElementById('correo').value = "";
                        // mostramos un mensaje primero activamos el div
                        document.getElementById('mensajeCorreo').style.display = "block";
                        document.getElementById('mensajeCorreo').innerHTML = "El correo ya existe";
                        // lo mostramos solo 5 segundos
                        setTimeout(function() {
                            document.getElementById('mensajeCorreo').style.display = "none";
                            document.getElementById('mensajeCorreo').innerHTML = "";
                        }, 5000);
                    } else {
                        // El correo no existe
                        // Puedes realizar otras acciones si deseas
                    }
                },
                error: function(xhr, status, error) {
                    // Manejo de errores si la solicitud falla
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    

</body>
</html>
