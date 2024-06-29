<?php

include_once 'header.php';
session_start( );
?>

<style>
form{ float: left; width: 45%;}
</style>

<h1>Resgistrate para continuar</h1>

<?php
if( isset($_GET['alta'])){
	echo 'ya podes iniciar sesion';
}
if( isset($_GET['login'])){
	echo '<strong style="color: red" class="">Mal tu usuario o tu clave</strong>';
}
//var_dump($_SESSION);

?>
<form method="post" action="alta.php" class="centro">
	<h2>REGISTRO</h2>
	
	<div><input type="nombre" placeholder="Dame tu nombre" name="nombre" /></div>
	<div><input type="apellido" placeholder="Dame tu apellido" name="apellido" /></div>
	<div><input type="email" placeholder="Dame tu email" name="email" /></div>
	<div><input type="password" placeholder="Dame tu clave" name="clave" /></div>
	<div><input type="submit" value="registrame" /></div>
</form>



<div class="">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>
