<?php
session_start();

if (!isset($_SESSION['NIVEL']) || $_SESSION['NIVEL'] != 'Admin') {
    die('NO TENES PERMISOS');
}

$cnx = mysqli_connect('localhost', 'root', '', 'basedatos');

$c = "SELECT ID,NIVEL, IFNULL(NOMBRE, '----') AS NOMBRE, ESTADO, IFNULL(APELLIDO, '----') AS APELLIDO, EMAIL, DATE_FORMAT( FECHA_ALTA, '%d/%m/%Y' ) AS FECHA FROM usuarios ORDER BY FECHA_ALTA DESC";
$r = mysqli_query($cnx, $c);

?>

<?php
include_once 'header.php';
?>
<div class="tablaAdmin">
    <div class="tabla-responsive">
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>EMAIL</th>
                    <th>NIVEL</th>
                    <th>FECHA</th>
                    <th>ESTADO</th>
                    <th>BOTONES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($a = mysqli_fetch_assoc($r)) {

                    echo '<tr>';
                    echo '<td>' . $a['NOMBRE'] . '</td>';
                    echo '<td>' . $a['APELLIDO'] . '</td>';
                    echo '<td>' . $a['EMAIL'] . '</td>';
                    echo '<td>' . $a['NIVEL'] . '</td>';
                    echo '<td>' . $a['FECHA'] . '</td>';
                    echo '<td>' . $a['ESTADO'] . '</td>';
                    echo '<td>';

                    if ($a['ESTADO'] == 'activo') {
                        echo '<a href="bannear.php?id=' . $a['ID'] . '" class="mi-clase">BANNEAR</a>';
                    } else {

                        echo '<a href="no_bannear.php?id=' . $a['ID'] . '" class="mi-clase">ACTIVAR</a>';
                    }
                    echo ' | ';

                    if ($a['NIVEL'] == 'usuario') {
						echo '<a href="adminizar.php?id=' . $a['ID'] . '" class="mi-clase">HACER ADMIN</a>';
					} else {
						echo '<a href="no_adminizar.php?id=' . $a['ID'] . '" class="mi-clase">HACER USUARIO</a>';
					}
					

                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="alinearVolverAlInicio "> 
	<p><a href="../../index.php">VOLVER AL INICIO</a></p>
    <p><a href="AMB/productos.php">ABM</a></p>
</div>

<div class="">
    <div class="col-7">
        <?php
        include_once 'footer.php';
        ?>
    </div>
</div>
