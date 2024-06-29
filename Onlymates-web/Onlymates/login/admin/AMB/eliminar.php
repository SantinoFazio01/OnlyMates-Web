<?php
include_once 'header.php';

if (mysqli_connect("localhost", "root", "", "basedatos")) {
    $con = mysqli_connect('localhost', 'root', '', 'basedatos');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['eliminar'])) {
            $idMate = $_POST['id_mate'];

            // Eliminar el mate de la base de datos
            $consulta = "DELETE FROM mates WHERE id_mate='$idMate'";
            if (mysqli_query($con, $consulta)) {
                ?>
                    <div class="container" id="bajarEliminado">
                        <div class="formAlta">      
                            <p>Se elimino correctacmente</p><br>
                            <a href='productos.php' id="volvABM">Volver al ABM de Productos</a>
                        </div>
                    </div>

                <?php
            } else {
                echo "Error al eliminar el mate: " . mysqli_error($con);
            }
        }
    } elseif (isset($_GET['id'])) {
        $idMate = $_GET['id'];

        $consulta = "SELECT * FROM mates WHERE id_mate='$idMate'";

        if ($resultado = mysqli_query($con, $consulta)) {
            $fila = mysqli_fetch_array($resultado);
?>

<div class="container ">
    <div class="formAlta">

        <h1>Confirmar Eliminación</h1>
    
        <p>¿Estás seguro de que deseas eliminar el mate "<?= $fila['nombre']; ?>"?</p>
        <form action="" method="post">
            <input type="hidden" name="id_mate" value="<?= $fila['id_mate']; ?>">
            <input type="submit" name="eliminar" value="Eliminar">
        </form>
    </div>
</div>
<?php
        }
    } else {
        echo "No se recibió la solicitud de eliminación.";
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
