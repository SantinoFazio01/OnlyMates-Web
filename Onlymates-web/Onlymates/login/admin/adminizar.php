<?php
include_once 'header.php';

$id = $_GET['id'];

$cnx = mysqli_connect('localhost','root','','basedatos');


$c = "UPDATE usuarios SET NIVEL='Admin' WHERE ID='$id'";

mysqli_query($cnx, $c);
header("Location: index.php");

include_once 'footer.php';

?>