<?php

$cnx = mysqli_connect('localhost','root','','basedatos');

$e = $_POST['email'];
$c = $_POST['clave'];
$n = $_POST['nombre'];
$a = $_POST['apellido'];

$q =<<<ALGO
	INSERT INTO 
		usuarios 
	SET 
		NOMBRE='$n',
		APELLIDO='$a',
		EMAIL='$e', 
		CLAVE=MD5('$c'),
		NIVEL='usuario',
		FECHA_ALTA=NOW( )
ALGO;

mysqli_query($cnx, $q);
header("Location:ingresar.php?alta=ok");



?>