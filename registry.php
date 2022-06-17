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
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="src/css/pages/normalize.min.css">
    <link rel="stylesheet" href="src/css/fonts/font-icons.min.css">
    <link rel="stylesheet" href="src/css/fonts/font-main.min.css">
    <link rel="stylesheet" href="src/css/pages/login.min.css">
</head>
<body class="background-main">
    <div class="banner-main">
        <img class="background-img" src="src/src-images/images/Fondo01.jpg" alt="Fondo de la pagina web | exowish">
        <div class="box">
            <div class="box-body">
                <img class="logotipo" src="src/src-images/images/Logotipo.png" alt="Logotipo de exowish.">
                <form method="post">
                    <div class="input-box">
                        <input name="nombre" class="input" type="text" placeholder="Nombre(s) y Apellido(s)" required>
                        <span class="input-icons icon-user"></span>
                    </div>
                    <div class="input-box">
                        <input name="usuario" class="input" type="text" placeholder="Usuario" required>
                        <span class="input-icons icon-star"></span>
                    </div>
                    <div class="input-box">
                        <input name="email" class="input" type="email" placeholder="Ejemplo@exowish.com" required>
                        <span class="input-icons icon-mail"></span>
                    </div>
                    <div class="input-box">
                        <input name="contrasena" class="input" type="password" placeholder="Ingrese su contraseña" required>
                        <span class="input-icons icon-lock"></span>
                    </div>
                    <div class="input-box">
                        <input name="repcontrasena" class="input" type="password" placeholder="Repita su contraseña" required>
                        <span class="input-icons icon-shield"></span>
                    </div>
                    <input class="submit" type="submit" name="registrar" value="Crear Cuenta">
                </form>
                <?php
                    if (isset($_POST['registrar'])) {
                        $nombre = mysqli_real_escape_string($_POST['nombre']);
                        $email = mysqli_real_escape_string($_POST['email']);
                        $usuario = mysqli_real_escape_string($_POST['usuario']);
                        $contrasena = mysqli_real_escape_string($_POST['contrasena']);
                        $repcontrasena = mysqli_real_escape_string($_POST['repcontrasena']);
                        $comprobarusuario = mysqli_num_rows(mysqli_query("SELECT usuario FROM usuarios WHERE usuario = '$usuario'"));
                        if ($comprobarusuario >= 1) { ?>
                            <br>
                            <div class="error">
                                <button class="close">×</button>
                                El nombre de usuario está en uso, por favor escoja otro.
                            </div>
                        <?php 
                        } else {
                            if ($contrasena != $repcontrasena) { ?>
                                <br>
                                <div class="error">
                                    <button class="close">×</button>
                                    Las contraseñas no coinciden, por favor vuelva a introducirlas.
                                </div>
                            <?php
                            } else {
                                $insertar = mysqli_query("INSERT INTO usuarios (nombre,usuario,contrasena,email,fecha_reg) values ('$nombre','$usuario','$contrasena','$email',now())");
                                if ($insertar) { ?>
                                    <br>
                                    <div class="error">
                                        <button class="close">×</button>
                                        Felicitaciones se registro correctamente.
                                    </div>
                                <?php
                                    header('Refresh: 2; url = login.php');
                                }
                            }
                        }
                    } ?>
                <p class="text">¿Ya tienes cuenta?</p>
                <a class="text" href="login.php">Iniciar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
