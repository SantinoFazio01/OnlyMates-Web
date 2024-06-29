<?php

session_start();

$cnx = mysqli_connect('localhost','root','','basedatos');

$email = $_POST['email'];
$clave = $_POST['clave'];

$c = "SELECT NOMBRE, APELLIDO, EMAIL, ID, NIVEL FROM usuarios WHERE EMAIL='$email' AND CLAVE=MD5('$clave') LIMIT 1";

$f = mysqli_query($cnx, $c);
$a = mysqli_fetch_assoc($f);

if ($a == NULL) {
    header("Location: ingresar.php?login=error");
    exit(); // Agregar exit() después de redireccionar para detener la ejecución posterior
} else {
    $_SESSION['NOMBRE'] = $a['NOMBRE'];
    $_SESSION['APELLIDO'] = $a['APELLIDO'];
    $_SESSION['EMAIL'] = $a['EMAIL'];
    $_SESSION['ID'] = $a['ID'];
    $_SESSION['NIVEL'] = $a['NIVEL'];
    header("Location: logueado.php");
    exit(); // Agregar exit() después de redireccionar para detener la ejecución posterior
}

?>
