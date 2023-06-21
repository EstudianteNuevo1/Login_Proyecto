<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form_login";

$enlace = mysqli_connect($servername, $username, $password, $database);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['enviar'])) {
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($enlace, $_POST['contrasena']);

    // Verificar si el registro ya existe
    $consultaExistencia = "SELECT * FROM usuarios2 WHERE correo = '$correo'";
    $resultadoExistencia = mysqli_query($enlace, $consultaExistencia);

    if (mysqli_num_rows($resultadoExistencia) > 0) {
        echo "El usuario ya está registrado.";
    } else {
        // Insertar el nuevo registro
        $insertarDatos = "INSERT INTO usuarios2 (correo, contrasena) VALUES ('$correo', '$contrasena')";
        $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

        if ($ejecutarInsertar) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar los datos: " . mysqli_error($enlace);
        }
    }
}

if (isset($_POST['login'])) {
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($enlace, $_POST['contrasena']);

    // Verificar las credenciales
    $consultaCredenciales = "SELECT * FROM usuarios2 WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resultadoCredenciales = mysqli_query($enlace, $consultaCredenciales);

    if (mysqli_num_rows($resultadoCredenciales) == 1) {
        // Credenciales válidas, redireccionar a la página deseada
        header("Location: Post-Template.html");
        exit();
    } else {
        echo "Credenciales inválidas.";
    }
}
?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login-Proyecto ODS-13</title>
    <link rel="icon" href="/Proyecto Ecologia ODS-13/assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Iniciar Sesión
            </div>

            <div class="title signup">
                Registrarse
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Iniciar</label>
                <label for="signup" class="slide signup">Registrarse</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="#" class="login" name="form_login" method="post">
                    <div class="field">
                        <input type="text" placeholder="Email" name="correo" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Contraseña" name="contrasena" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Iniciar" name="login">
                    </div>
                </form>
                <form action="#" class="signup" name="form_signup" method="post">
                    <div class="field">
                        <input type="text" placeholder="Email" name="correo" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Contraseña" name="contrasena" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Confirmar Contraseña" name="confirmar_contrasena" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Registrarse" name="enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>
