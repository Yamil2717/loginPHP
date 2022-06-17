<?php
session_start();
include 'src/includes/functions/db.php';
ini_set('error_reporting', 0);
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
} ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="HandheldFriendly" content="true" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="src/css/pages/normalize.min.css">
    <link rel="stylesheet" href="src/css/fonts/font-icons.min.css">
    <link rel="stylesheet" href="src/css/fonts/font-main.min.css">
    <link rel="stylesheet" href="src/css/pages/login.min.css">
</head>
<body class="background-main">
    <div class="banner-main">
        <img class="background-img" src="src/src-images/images/Fondo01.jpg" alt="Fondo de la pagina web Exowish">
        <div class="box">
            <div class="box-body">
                <img class="logotipo" src="src/src-images/images/Logotipo.png" alt="Logotipo de exowish.">
                <form method="post">
                    <div class="input-box">
                        <input name="usuario" class="input" type="text" placeholder="Usuario">
                        <span class="input-icons icon-star"></span>
                    </div>
                    <div class="input-box">
                        <input name="contrasena" class="input" type="password" placeholder="Ingrese su contraseña">
                        <span class="input-icons icon-shield"></span>
                    </div>
                    <input name="login" class="submit" type="submit" value="Iniciar sesión">
                </form>
                <?php
                if (isset($connect, $_POST['login'])) {
                    $usuario = mysqli_real_escape_string($connect, $_POST['usuario']);
                    $usuario = strip_tags($_POST['usuario']);
                    $usuario = trim($_POST['usuario']);
                    $contrasena = mysqli_real_escape_string($connect, md5($_POST['contrasena']));
                    $contrasena = strip_tags(md5($_POST['contrasena']));
                    $contrasena = trim(md5($_POST['contrasena']));
                    $query = mysqli_query($connect, "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");
                    $contar = mysqli_num_rows($query);
                    if ($contar == 1) {
                        while ($row = mysqli_fetch_array($query)) {
                            if ($usuario = $row['usuario'] && $contrasena = $row['contrasena']) {
                                $_SESSION['usuario'] = $row['usuario'];
                                $_SESSION['id'] = $row['id_use'];
				                $_SESSION['nombre'] = $row['nombre'];
				                $_SESSION['email'] = $row['email'];
				                $_SESSION['registro'] = $row['fecha_reg'];
                                header('Location: index.php');
                            }
                        }
                    } else {
                        echo '
                        <br>
                        <div class="error">
                            <button class="close">×</button>
                            Los datos ingresados no son correctos.
                        </div>';
                    }
                } ?>
                <p class="text">¿No tienes cuenta aún?</p>
                <a class="text" href="registry.php">Registrarse</a>
                <a class="text" href="#">¿Olvidaste tú contraseña?</a>
            </div>
        </div>
    </div>
</body>
</html>