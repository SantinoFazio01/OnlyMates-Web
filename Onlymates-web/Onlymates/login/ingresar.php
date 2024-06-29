<?php



session_start();

// Verificar si el usuario ya ha iniciado sesión y redirigir si es necesario
if (isset($_SESSION['ID']) && basename($_SERVER['PHP_SELF']) == "ingresar.php") {
  header("Location: logueado.php");
  exit();
}
include_once 'header.php';

?>
 
<div id="bajarFormulario">
  <div class="form-container">
    <div class="login">
      <div class="form">
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="post" class="form">
          <input type="email" placeholder="Ingresa tu email" name="email" required="" />
          <input type="password" placeholder="Ingresa tu clave" name="clave" required="" />
          <input class="submit" type="submit" value="INGRESAR" />
        </form>
      </div>
    </div>
  </div>

  <div class="form-container">
    <div class="login2">
      <div class="form">
        <h2>Registrarse</h2>
        <form action="alta.php" method="post" class="form">
          <div><input type="nombre" placeholder="Ingresa tu nombre" name="nombre" required="" /></div>
          <div><input type="apellido" placeholder="Ingresa tu apellido" name="apellido" required="" /></div>
          <div><input type="email" placeholder="Ingresa tu email" name="email" required="" /></div>
          <div><input type="password" placeholder="Ingresa tu clave" name="clave" required="" /></div>
          <input type="submit" class="submit" value="Registrar" />
        </form>
      </div>
    </div>
  </div>
</div>










<div class="feet">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>
