<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'yamil_f3';
$connect = mysqli_connect($server, $user, $password);
    if (!$connect) {
        echo 'No se ha conectado a la base de datos';
    } else {
        $select = mysqli_select_db($connect, $database);
    }
?>
