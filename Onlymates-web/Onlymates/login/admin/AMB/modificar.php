<?php
include_once 'header.php';

if (mysqli_connect("localhost", "root", "", "basedatos")) {
    $con = mysqli_connect('localhost', 'root', '', 'basedatos');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
        $idMate = $_POST['id_mate'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $codigo = $_POST['codigo'];
        $imagen = $_POST['imagen'];

        // Validación de los datos (puedes agregar más validaciones según tus necesidades)
        if (!empty($nombre) && !empty($precio) && !empty($codigo) && !empty($imagen)) {
            $nombre = mysqli_real_escape_string($con, $nombre);
            $precio = floatval($precio);
            $codigo = mysqli_real_escape_string($con, $codigo);
            $imagen = mysqli_real_escape_string($con, $imagen);

            // Actualizar el mate en la base de datos
            $consulta = "UPDATE mates SET nombre='$nombre', precio=$precio, codigo='$codigo', imagen='$imagen' WHERE id_mate=$idMate";
            if (mysqli_query($con, $consulta)) {
            
    ?>
            <div class="container" id="bajarEliminado">
                        <div class="formAlta">      
                            <p>"El mate ha sido actualizado exitosamente."</p><br>
                            <a href='productos.php' id="volvABM">Volver al ABM de Productos</a>
                        </div>
                    </div>
    <?php               
        } else {
                echo "Error al actualizar el mate: " . mysqli_error($con);
            }
        } else {
            echo "Por favor, completa todos los campos.";
        }
    } elseif (isset($_GET['id'])) {
        $idMate = $_GET['id'];

        $consulta = "SELECT * FROM mates WHERE id_mate='$idMate'";

        if ($resultado = mysqli_query($con, $consulta)) {
            $fila = mysqli_fetch_array($resultado);
?>
            <div class="container">

                <div class="formAlta">
                 <h1>Modificar Mate</h1>
    
                    <form action="" method="post">
                        <input type="hidden" name="id_mate" value="<?= $fila['id_mate']; ?>">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?= $fila['nombre']; ?>">
                        <br>
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" step="0.01" value="<?= $fila['precio']; ?>">
                        <br>
                        <label for="codigo">Código:</label>
                        <input type="text" id="codigo" name="codigo" value="<?= $fila['codigo']; ?>">
                        <br>
                        <label for="imagen">Imagen:</label>
                        <input type="text" id="imagen" name="imagen" value="<?= $fila['imagen']; ?>">
                        <br>
                        <input type="submit" name="modificar" value="Modificar">
                    </form>
                </div>
            </div>
<?php
        }
    }
} else {
    echo "No se pudo conectar a la base de datos";
}
?>
<div class="">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>