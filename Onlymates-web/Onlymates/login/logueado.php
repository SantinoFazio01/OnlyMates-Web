<?php
session_start( );
include_once 'header.php';

if( !isset( $_SESSION['ID'] ) ){
	header("Location: ../index.php?forbidden=1");

	

}

 var_dump ($_SESSION['NOMBRE'],$_SESSION['EMAIL'],$_SESSION['NIVEL']);
?>

<br>
<a class="text" href="logout.php">Cerrar sesion</a>
<a class="text" href="admin/adminizar.php">Administrar</a>

<div class="">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>
