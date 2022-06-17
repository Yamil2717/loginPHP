<?php
session_start();
include 'src/includes/functions/db.php';
ini_set('error_reporting', 0);
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
} ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="HandheldFriendly" content="true" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="RATING" content="RTA-5042-1996-1400-1577-RTA" />
    <title>Exowish</title>
</head>
<body>
    <?php
    $user = strip_tags($_SESSION['usuario']);
    $nombre = strip_tags($_SESSION['nombre']);
    $email = strip_tags($_SESSION['email']);
    $registro = strip_tags($_SESSION['registro']);
    ?>
	<p>Su usuario es: <b><?php echo $user;?></b></p>
	<p>Su nombre es: <b><?php echo $nombre;?></b></p>
	<p>Su email es: <b><?php echo $email;?></b></p>
    <p>Se registro el día: <b><?php echo $registro;?></b></p>
    <a href="logout.php">Desconectarse</a>
</body>
</html>