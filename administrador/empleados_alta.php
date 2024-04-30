<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Alta empleados</title>
    <!-- CSS con estilo cyberpunk para el formulario -->
    <link rel="stylesheet" href="../estilos/estiloCyberpunk.css">
    <!-- php para empleados_salva.php -->
    <script src="empleados_salva.php"></script>
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
    <form id="formulario" name="formulario" action="empleados_salva.php" method="POST" onsubmit="return validar();" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" >
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Apellido">
        <label for="correo">
            Correo:
        </label>
        <div class="contCorreo">
            
            <input type="text" id="correo" name="correo" placeholder="Correo" onblur="verificarCorreo();">
            <!-- mensaje de correo ya existente -->
            <div id="mensajeCorreo"></div>
        </div>

        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" placeholder="Contraseña">

        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="0">Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select>
        <label for="imagen">Imagen:</label>
        <input name="archivo" type="file" id = "archivo">
        <br>
        <br>

        <button type="submit">Registrar</button> 
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
            if (nombre == "" || apellido == "" || correo == "" || pass == "" || rol == "0" || imagen == "") {
                // mostramos un mensaje primero activamos el div
                document.getElementById('mensajeFaltaDatos').style.display = "block";
                document.getElementById('mensajeFaltaDatos').innerHTML = "Faltan datos por llenar";
                // lo mostramos solo 5 segundos
                setTimeout(function() {
                    document.getElementById('mensajeFaltaDatos').style.display = "none";
                    document.getElementById('mensajeFaltaDatos').innerHTML = "";
                }, 5000);
                return false;

            } else {
                alert("El usuario se ha registrado correctamente");
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
                    correo: correo
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
