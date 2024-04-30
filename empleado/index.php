<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login empleados</title>
    <!-- CSS con estilo cyberpunk para el formulario -->
    <link rel="stylesheet" href="../estilos/estiloCyberpunk.css">
    <!-- php para empleados_valida.php -->
    <script src="empleados_valida.php"></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- Formulario de login de empleados -->
    <form id="formulario" name="formulario" onsubmit="return validar() && enviar()">
        <label for="correo">
            Correo:
        </label>
        <div class="contCorreo">
            <input type="text" id="correo" name="correo" placeholder="Correo">
            <!-- mensaje de correo no registrado -->
            
        </div>
        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" placeholder="Contraseña">
        <!-- <button type="submit">Ingresar</button> -->
        <!-- en lugar de un boton de tipo submit, usamos un boton de tipo button que ejecute las funciones de validar y enviar -->
        <button type="button" onclick="validar() && enviar()">Ingresar</button>
        <!-- div para mostrar mensaje de falta de datos -->
        <div id="mensajeFaltaDatos"></div>
    </form>
    <script>
        // Funcion para validar los datos del formulario
        function validar() {
            // Obtenemos los valores de los campos
            var correo = document.getElementById("correo").value;
            var pass = document.getElementById("pass").value;
            // Verificamos que los campos no esten vacios
            if (correo == "" || pass == "") {
                document.getElementById("mensajeFaltaDatos").innerHTML = "Faltan datos";
                // mostramos solo 5 segundos el mensaje
                setTimeout(function() {
                    document.getElementById("mensajeFaltaDatos").innerHTML = "";
                }, 5000);
                return false;
            }
            
            return true;
        }
        // Funcion para mandar los datos del formulario por AJAX
        function enviar() {
            
            // Obtenemos los valores de los campos
            var correo = document.getElementById("correo").value;
            var pass = document.getElementById("pass").value;
            // Mandamos los datos por AJAX
            $.ajax({
                url: 'empleados_valida.php',
                type: 'post',
                data: {
                    correo: correo,
                    pass: pass
                },
                success: function(data) {
                    // Mostramos la respuesta del servidor
                    // Si el correo no esta registrado
                    if (data.trim() == "no") {
                        document.getElementById("mensajeFaltaDatos").innerHTML = "Datos incorrectos";
                        // mostramos solo 5 segundos el mensaje
                        setTimeout(function() {
                            document.getElementById("mensajeFaltaDatos").innerHTML = "";
                        }, 5000);
                    }
                    // Si los datos son correctos
                    if (data.trim() == "correcto") {
                        
                        // Redireccionamos a la pagina de empleados
                        window.location.href = "bienvenida.php";
                    }
                }
            });
        }
    </script>
</body>
</html>